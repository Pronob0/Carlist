<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class DepositController extends Controller
{
    public function __construct()
    {
        if(auth()->user()){
            if(auth()->user()->is_vendor != 1){
                return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "You are not authorized to access this page."]]);
            }
    }
        
    }
    public function gateways()
    {

        $success['gateways'] = PaymentGateway::where('status', 1)->get();
        return response()->json(['status' => true, 'data' => $success, 'error' => []]);
    }

    public function depositStore(Request $request)
    {


        $gateway = PaymentGateway::where('id', $request->gateway_id)->where('status', 1)->first();

        if (!$gateway) {
            return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid payment gateway']);
        }
        $user = auth()->user()->id;
        // $curr = Session::has('currency') ? Session::get('currency') : Currency::whereDefault(1)->first();
        $curr = Currency::where('id', $request->currency_id)->first();

        $amount = $request->amount;
        $curr = $curr->id;
        $gateway = $gateway->id;

        // return redirect()->route('final.form',['user'=>$user,'curr'=>$curr,'gateway'=>$gateway,'amount'=>$amount]);
        $route = route('final.form', ['user' => $user, 'curr' => $curr, 'gateway' => $gateway, 'amount' => $amount]);

        return response()->json(['status' => true, 'data' => ['route' => $route], 'error' => []]);
    }



    public function depositHistory(Request $request)
    {

        try {
            $user = auth()->user();
            if ($request->transaction_id != null) {
               
                $transaction_id = $request->transaction_id;
                $data['deposits'] = Deposit::where('txnid', $transaction_id)->where('user_id', auth()->id())->orderBy('id', 'DESC')->paginate(10)
                    ->through(function ($item) {
                        $item->update_created_at = Carbon::parse($item->created_at)->format('d M Y');
                        return $item;
                    });
                return response()->json(['status' => true, 'data' => $data, 'error' => []]);
            } else {
                $data['deposits'] = Deposit::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(10)
                    ->through(function ($item) {
                        $item->update_created_at = Carbon::parse($item->created_at)->format('d M Y');
                        return $item;
                    });
                return response()->json(['status' => true, 'data' => $data, 'error' => []]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }

    public function depositPreview($trx)
    {
        try {
            $data['deposit'] = Deposit::where('txnid', $trx)->where('user_id', auth()->id())->first();
            return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        } catch (\Exception $e) {
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }
}
