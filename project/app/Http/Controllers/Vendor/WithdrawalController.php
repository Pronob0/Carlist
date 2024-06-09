<?php

namespace App\Http\Controllers\Vendor;


use App\Models\Currency;
use App\Models\Withdraw;
use App\Models\Withdrawals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class WithdrawalController extends Controller
{
    public function __construct()
    {
        if(auth()->user()){
            if(auth()->user()->is_vendor != 1){
                return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "You are not authorized to access this page."]]);
            }
    }
        
    }

    public function methods(Request $request)
    {
        $curr = Session::has('currency') ? Session::get('currency') : Currency::whereDefault(1)->first();

        $methods = Withdraw::where('currency_id', $curr->id)->where('status', 1)->get()
            ->map(function ($data) {
                $data['min_amount'] = round($data['min_amount'], 2);
                $data['max_amount'] = round($data['max_amount'], 2);
                $data['fixed_charge'] = round($data['fixed_charge'], 2);
                return $data;
            });

        if ($methods->isEmpty()) {
            return response()->json(['status' => false, 'data'=>[], 'error' => 'No Data Found']);
        }

        return response()->json(['status' => true, 'data' => $methods, 'error' => []]);
    }

    public function withdrawSubmit(Request $request)
    {
        $request->validate([
            'amount'    => 'required|numeric|gt:0',
            'method_id' => 'required',

        ]);
        $user = auth()->user();

        $method = Withdraw::findOrFail($request->method_id);
        if (!$method) {

            return response()->json(['status' => false, 'data' => [], 'error' => 'Withdraw method not found']);
            
        }

        if ($request->amount < $method->min_amount || $request->amount > $method->max_amount) {
            $min = round($method->min_amount, 2);
            $max = round($method->max_amount, 2);
            $msg = 'Minimum amount:' . $min . ' and Maximum amount: ' . $max;
            return response()->json(['status' => false, 'data' => [], 'error' => $msg]);
        
        }

        $charge = chargeCalc($method, $request->amount);
        $finalAmount = numFormat($request->amount + $charge);

        if ($user->balance < $finalAmount) {

            return response()->json(['status' => false, 'data' => [], 'error' => 'Insufficient balance']);
        }

        $user->balance -=  $finalAmount;
        $user->save();

        $withdraw              = new Withdrawals();
        $withdraw->trx         = str_rand();
        $withdraw->user_id     = auth()->id();
        $withdraw->method_id   = $method->id;
        $withdraw->currency_id = $method->currency_id;
        $withdraw->amount      = $request->amount;
        $withdraw->charge      = $charge;
        $withdraw->total_amount = $finalAmount;
        $withdraw->user_data   = $request->user_data;
        $withdraw->save();
        return response()->json(['status' => true, 'data' => [], 'success' => 'Withdraw request submitted successfully']);

    }

    public function history(Request $request)
    {
        if ($request->transaction_id != null) {
          
            $transaction_id = $request->transaction_id;
            $withdrawals = Withdrawals::where('trx', $transaction_id)->where('user_id', auth()->id())->latest()->paginate(15)
                ->through(function ($data) {
                    $data['amount'] = round($data['amount'], 2);
                    $data['charge'] = round($data['charge'], 2);
                    $data['update_created_at'] = Carbon::parse($data->created_at)->format('d M Y');
                    return $data;
                });
            return response()->json(['status' => true, 'data' => $withdrawals, 'error' => []]);
        } else {
            $withdrawals = Withdrawals::where('user_id', auth()->id())->latest()->paginate(15)
                ->through(function ($data) {
                    $data['amount'] = round($data['amount'], 2);
                    $data['charge'] = round($data['charge'], 2);
                    $data['update_created_at'] = Carbon::parse($data->created_at)->format('d M Y');
                    return $data;
                });
            return response()->json(['status' => true, 'data' => $withdrawals, 'error' => []]);
        }
    }

    public function withdrawPreview($trx)
    {
        try {
            $data['withdraw'] = Withdrawals::where('trx', $trx)->where('user_id', auth()->id())->with('User:id,email,name,balance,balance,phone')->first();
            $data['amount'] = round($data['withdraw']->amount, 2);
            $data['charge'] = round($data['withdraw']->charge, 2);
            return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'data' => [], 'error' => $e->getMessage()]);
        }
    }
}
