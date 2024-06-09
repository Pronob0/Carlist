<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Jobs\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        if(auth()->user()){
            if(auth()->user()->is_vendor != 1){
                return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "You are not authorized to access this page."]]);
            }
    }
        
    }
    public function transaction(){
        $transaction = Transaction::where('user_id', auth()->id())->latest()->paginate(10);
        $data['transaction'] = TransactionResource::collection($transaction)->response()->getData(true);
    }
}
