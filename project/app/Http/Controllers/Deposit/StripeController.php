<?php

namespace App\Http\Controllers\Deposit;

use App\Classes\GeniusMailer;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Error\Card;
use Carbon\Carbon;
use Input;
use Redirect;
use URL;
use Validator;
use Config;

class StripeController extends Controller
{
    public $data;
    public function __construct()
    {
        $this->data = PaymentGateway::whereKeyword('stripe')->first();
        $paydata = $this->data->convertAutoData();
        \Stripe\Stripe::setApiKey($paydata['secret']);
    }

    public function store(Request $request, $amount, $user, $currency){

        $curr = Currency::findOrFail($currency);
        $item_number = Str::random(4).time();
        $item_amount = $request->amount;
        $support = $this->data->currency_id;
        $gs = Generalsetting::findOrFail(1);
        if(!in_array($curr->id,$support)){
            $unsuccess = $gs->fron_domain.'/payment-failed?msg=This Currency Is Not Supported By This Gateway';
            
            return redirect($unsuccess);
        }

        $user = User::findOrFail($user);
        $gs = Generalsetting::findOrFail(1);

        

        $session = \Stripe\Checkout\Session::create([
            "line_items" => [
                [
                    "quantity" => 1,
                    "price_data" => [
                        "currency" => $curr->code,
                        "unit_amount" =>$item_amount*100,
                        "product_data" => [
                            "name" => $gs->title . 'Deposit'
                        ]
                    ]
                ]
                ],
            'mode' => 'payment',
            "locale" => "auto",
            'success_url' => route('user.deposit.success', [$amount, $user, $currency], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('deposit.paypal.cancel', [], true),
          ]);
          return redirect($session->url);

        }

        public function success(Request $request, $amount, $user, $currency)
        {
            
            $deposit = new Deposit();
            $user= User::findOrFail($user);
            $gs= Generalsetting::first();
            $item_number = Str::random(4).time();
            
            $item_amount = $amount;
            $sessionId = $request->get('session_id');
           
            try{
                $session = \Stripe\Checkout\Session::retrieve($sessionId);

        
                if (!$session) {
                    throw new NotFoundHttpException;
                }
                $request = Session::get('request');
                if ($session->payment_status == 'paid'  && $session->status=='complete') {
                    $currency = Currency::where('id',$currency)->first();
                    
                    $amountToAdd = $amount/$currency->rate;

                    $deposit['deposit_number'] = Str::random(12);
                    $deposit['user_id'] = $user->id;
                    $deposit['currency_id'] = $currency->id;
                    $deposit['amount'] = $amountToAdd;
                    $deposit['method'] = 'Stripe';
                    $deposit['txnid'] = $session->payment_intent;
                    $deposit['charge_id'] = $sessionId;
                    $deposit['status'] = "complete";
                    $deposit->save();

                    $gs =  Generalsetting::findOrFail(1);
        
                    $user = User::findOrFail($user->id);
                    $user->balance += $amountToAdd;
                    $user->save();
        
                    $trans = new Transaction();
                    $trans->trnx = $deposit->deposit_number;
                    $trans->user_id = $user->id;
                    $trans->amount = $deposit->amount/$currency->rate;
                    $trans->currency_id = $deposit->currency_id;
                    $trans->remark = "add_balance";
                    $trans->type = "+";
                    $trans->details = "Deposit Via Stripe";
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
                
            }catch (Exception $e){
                return back()->with('unsuccess', $e->getMessage());
            }

            $unsuccess = $gs->fron_domain.'/payment-failed';
            return redirect($unsuccess);

        
    }
}
