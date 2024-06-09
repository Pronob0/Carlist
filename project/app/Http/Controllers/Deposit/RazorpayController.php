<?php

namespace App\Http\Controllers\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public $keyId;
    public $keySecret;
    public $displayCurrency;
    public $api;
    public $data;
    public $gs;
    public function __construct()
    {
        $this->data = PaymentGateway::whereKeyword('razorpay')->first();
        $paydata = $this->data->convertAutoData();
        $this->keyId = $paydata['key'];
        $this->keySecret = $paydata['secret'];
        $this->displayCurrency = 'INR';
        $this->api = new Api($this->keyId, $this->keySecret);
        $this->gs = Generalsetting::findOrFail(1);
    }

    public function store(Request $request, $amount, $user, $currency)
    {
       
        $curr = Currency::findOrFail($currency);
        $support = $this->data->currency_id;
        $user = User::findOrFail($user);
     
        if(!in_array($curr->id,$support)){
            return response()->json(['status' => false, 'data' => [], 'error' => ['Invalid Currency']]);
      }

        $settings = Generalsetting::findOrFail(1);
        $deposit = new Deposit();

        $input = $request->all();
        $item_name = $settings->title." Deposit";
        $item_number = Str::random(12);
        $item_amount = $request->amount;

        $order['item_name'] = $item_name;
        $order['item_number'] = $item_number;
        $order['item_amount'] = round($item_amount,2);
        $cancel_url = $unsuccess = $this->gs->fron_domain.'/payment-failed';
        $notify_url = route('deposit.razorpay.notify');


        $orderData = [
            'receipt'         => $order['item_number'],
            'amount'          => $order['item_amount'] * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $this->api->order->create($orderData);

        $input['user_id'] = $user->id;
        $input['currency_id'] = $curr->id;
        $input['amount'] = $order['item_amount']/ $curr->rate;

        Session::put('input_data',$input);
        Session::put('order_data',$order);
        Session::put('order_payment_id', $razorpayOrder['id']);

        $displayAmount = $amount = $orderData['amount'];

        if ($this->displayCurrency !== 'INR')
        {
            $url = "https://api.fixer.io/latest?symbols=$this->displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);

            $displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
        }

        $checkout = 'automatic';

        if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
        {
            $checkout = $_GET['checkout'];
        }

        $data = [
            "key"               => $this->keyId,
            "amount"            => $amount,
            "name"              => $order['item_name'],
            "description"       => $order['item_name'],
            "prefill"           => [
                "name"              => $request->customer_name,
                "email"             => $request->customer_email,
                "contact"           => $request->customer_phone,
            ],
            "notes"             => [
                "address"           => $request->customer_address,
                "merchant_order_id" => $order['item_number'],
            ],
            "theme"             => [
                "color"             => "{{$settings->colors}}"
            ],
            "order_id"          => $razorpayOrder['id'],
        ];

        if ($this->displayCurrency !== 'INR')
        {
            $data['display_currency']  = $this->displayCurrency;
            $data['display_amount']    = $displayAmount;
        }

        $json = json_encode($data);
        $displayCurrency = $this->displayCurrency;

        return view( 'razorpay', compact( 'data','displayCurrency','json','notify_url' ) );
    }

    public function notify(Request $request)
    {
       
        $input = Session::get('input_data');
        $order_data = Session::get('order_data');
        $input_data = $request->all();

        $payment_id = Session::get('order_payment_id');



        // dd($input, $input_data, $order_data, $payment_id);

        $success = true;

        if (empty($input_data['razorpay_payment_id']) === false)
        {

            try
            {
                $attributes = array(
                    'razorpay_order_id' => $payment_id,
                    'razorpay_payment_id' => $input_data['razorpay_payment_id'],
                    'razorpay_signature' => $input_data['razorpay_signature']
                );

                $this->api->utility->verifyPaymentSignature($attributes);
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
            }
        }

        if ($success === true){
            $currency = Currency::where('id',$input['currency_id'])->first();
            $amountToAdd = $input['amount'];

          
            $deposit = new Deposit();
            $deposit['deposit_number'] = $order_data['item_number'];
            $deposit['user_id'] = $input['user_id'];
            $deposit['currency_id'] = $input['currency_id'];
            $deposit['amount'] = $amountToAdd;
            $deposit['method'] = 'Razorpay';
            $deposit['status'] = "complete";
            $deposit['txnid'] = $payment_id;
            $deposit->save();



            $gs =  Generalsetting::findOrFail(1);

            $user = User::findOrFail($input['user_id']);
            $user->balance += $amountToAdd;
            $user->save();

            $trans = new Transaction();
            $trans->trnx = $deposit->deposit_number;
            $trans->user_id = $user->id;
            $trans->amount = $deposit->amount;
            $trans->currency_id = $deposit->currency_id;
            $trans->remark = "add_balance";
            $trans->type = "+";
            $trans->details = "Deposit Via Razorpay";
            $trans->save();

            if($gs->mail_type == 'php_mailer')
                {
                   
                    @email([
                        'email'   => $user->email,
                        'name'    => $user->username,
                        'subject' => 'Deposit'.$gs->title,
                        'message' => 'You have deposited successfully. <br> Amount: '.$deposit->amount.' '.$deposit->currency->code.'<br> Method: Razorpay',
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

        }
        $unsuccess = $gs->fron_domain.'/payment-failed';
        return redirect($unsuccess);
    }
}
