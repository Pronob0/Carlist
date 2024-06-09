<?php

namespace App\Http\Controllers\Deposit;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction as ModelsTransaction;
use App\Models\User;
use Omnipay\Omnipay;


class PaypalController extends Controller
{
    private $_api_context;
    public $gateway;
    public $data;

    public function __construct()
    {
       
        $this->data = PaymentGateway::whereKeyword('paypal')->first();
        $paydata = $this->data->convertAutoData();
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId($paydata['client_id']);
        $this->gateway->setSecret($paydata['client_secret']);
        $this->gateway->setTestMode(true);
       
    }

    public function store(Request $request, $amount, $user, $currency){
       

        $curr = Currency::findOrFail($currency);
        auth()->loginUsingId($user);
        
        $support = $this->data->currency_id;
        $gs = Generalsetting::findOrFail(1);
        if(!in_array($curr->id,$support)){
            
            $unsuccess = $gs->fron_domain.'/payment-failed?msg=This Currency Is Not Supported By This Gateway';
            
            return redirect($unsuccess);
        }
        $id = auth()->user()->id;
        $settings = Generalsetting::findOrFail(1);
        $deposit = new Deposit();
        $item_name = $settings->title." Deposit";
        $item_number = Str::random(12);
        $item_amount = $amount;
        $amountToAdd = $amount/$curr->rate;
        $deposit['user_id'] = auth()->user()->id;
        $deposit['currency_id'] = $curr->id;
        $deposit['amount'] = $amountToAdd ;
        $deposit['method'] = 'Paypal';
        $deposit['deposit_number'] = $item_number;
        $deposit['status'] = "pending";
        $deposit->save();

        $cancel_url = route('deposit.paypal.cancel');
        $notify_url = route('deposit.paypal.notify', [ $item_number, $id]);
  

        

        try {
            $response = $this->gateway->purchase(array(
                'amount' => $item_amount,
                'currency' => $curr->code,
                'returnUrl' => $notify_url,
                'cancelUrl' => $cancel_url,
            ))->send();

            if ($response->isRedirect()) {
                if ($response->redirect()) {
                    /** redirect to paypal **/
                    return redirect($response->redirect());
                }
            } else {
                return response()->json(['status' => false, 'data' => [], 'error' => [$response->getMessage()]]);

            }
        } catch (\Throwable$th) {

            return response()->json(['status' => false, 'data' => [], 'error' => [$th->getMessage()]]);
        }

    }

    public function notify(Request $request, $num, $id)
    {
        $responseData = $request->all();
        $gs = Generalsetting::findOrFail(1);
        
        if (empty($responseData['PayerID']) || empty($responseData['token']))  {
            $unsuccess = $gs->fron_domain.'/payment-failed';
            return redirect($unsuccess);
        } 

        $transaction = $this->gateway->completePurchase(array(
            'payer_id' => $responseData['PayerID'],
            'transactionReference' => $responseData['paymentId'],
        ));
        $user = User::findOrFail($id);


        $response = $transaction->send();
        $deposit_number = $num;



        if ($response->isSuccessful()) {
           

                $deposit = Deposit::where('deposit_number',$deposit_number)->where('status','pending')->first();
                
                $deposit->txnid = $response->getData()['transactions'][0]['related_resources'][0]['sale']['id'];
                $deposit->status = "complete";
                $deposit->save();

                $gs =  Generalsetting::findOrFail(1);
                if($gs->mail_type == 'php_mailer')
                {
                   
                    @email([
                        'email'   => $user->email,
                        'name'    => $user->username,
                        'subject' => 'Deposit'.$gs->title,
                        'message' => 'You have deposited successfully. <br> Amount: '.$deposit->amount.' '.$deposit->currency->code.'<br> Method: Paypal',
                      ]);
                }
                else
                {
                    $to = $user->email;
                    $subject = " You have deposited successfully.";
                    $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    mail($to,$subject,$msg,$headers);
                }

                $user->balance += $deposit->amount/$deposit->currency->rate;
                $user->update();

                $trans = new ModelsTransaction();
                $trans->trnx = $deposit->deposit_number;
                $trans->user_id = $user->id;
                $trans->amount = $deposit->amount/$deposit->currency->rate;
                $trans->currency_id = $deposit->currency_id;
                $trans->remark = "add_balance";
                $trans->type = "+";
                $trans->details = "Deposit Via Paypal";
                $trans->save();

            $success = $gs->fron_domain.'/payment-success'; 
            return redirect($success);
            
        }

    }

    public function cancel()
    {
        $gs = Generalsetting::findOrFail(1);
        $unsuccess = $gs->fron_domain.'/payment-failed';
        return redirect($unsuccess);
    }
}
