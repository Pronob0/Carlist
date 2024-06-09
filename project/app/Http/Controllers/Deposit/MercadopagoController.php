<?php

namespace App\Http\Controllers\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use MercadoPago;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\DepositRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MercadopagoController extends Controller
{
    public $orderRepositorty;
    public  $allusers = [];
    public $data;
   

   
    public function store(Request $request, $amount, $user, $currency){
       
        
        $gs = Generalsetting::findOrFail(1);
        $user = User::findOrFail($user);
        $this->data = PaymentGateway::whereKeyword('mercadopago')->first();
        $curr = Currency::findOrFail($currency);
        $item_name = $gs->title." Deposit";
        $item_number = Str::random(12);
        $item_amount = $request->amount;
        $amountToAdd = $amount/$curr->rate;
        $support = $this->data->currency_id;
      
        $gs = Generalsetting::findOrFail(1);
        if(!in_array($curr->id,$support)){
            $unsuccess = $gs->fron_domain.'/payment-failed?msg=This Currency Is Not Supported By This Gateway';
            
            return redirect($unsuccess);
        }

        $payment_amount =   $amountToAdd;
        $paydata = $this->data->convertAutoData();
        MercadoPago\SDK::setAccessToken($paydata['token']);
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = $payment_amount;
        $payment->token = $request->token;
        $payment->description = 'Deposit '.$gs->title;
        $payment->installments = 1;
        $payment->payer = array(
        "email" => $user ? $user->email : 'example@gmail.com'
        );
        
        $payment->save();

        if ($payment->status == 'approved') {

            $deposit = new Deposit();
            $deposit['deposit_number'] =  $item_number;
            $deposit['user_id'] = $user->id;
            $deposit['currency_id'] = $curr->id;
            $deposit['amount'] = $amountToAdd;
            $deposit['method'] = 'Stripe';
            $deposit['txnid'] =  $item_number;
            $deposit['charge_id'] =  
            $deposit['status'] = "complete";
            $deposit->save();
            
            

            $user->balance += $amountToAdd;
            $user->save();

            $trans = new Transaction();
                    $trans->trnx = $deposit->deposit_number;
                    $trans->user_id = $user->id;
                    $trans->amount = $amountToAdd;
                    $trans->currency_id = $deposit->currency_id;
                    $trans->remark = "add_balance";
                    $trans->type = "+";
                    $trans->details = "Deposit Via Mercadopago";
                    $trans->save();

            
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
    
                    $success = $gs->fron_domain.'/payment-success';
                    return redirect($success);
        }else{
            $unsuccess = $gs->fron_domain.'/payment-failed';
            return redirect($unsuccess);
        }
    }
}
