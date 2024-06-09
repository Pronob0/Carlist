<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdrawals;
use Illuminate\Http\Request;

class ManageVendorController extends Controller
{
    public function vendors(){
        $search = request('search');
        
        if (request('status') ==='active') {
            $status = 1;
        } elseif (request('status') === 'banned') {
            $status = 0;
        }
        elseif (request('status') === 'email_verified') {
            $email = 0;
        }
        elseif(request('status') === 'kyc_verified'){
            $kyc = 0;
        }
     
        $users = User::query();

        if ($search) {
            $users->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        if (isset($status)) {
            $users->where('status', $status);
        }
        if(isset($email)){
            $users->where('email_verified', $email);
        }
        if(isset($kyc)){
            $users->where('kyc_status', $kyc);
        }
        $users = $users->where('is_vendor',1)->latest()->paginate(15);
        return view('admin.vendor.index', compact('users', 'search'));
    }

    public function vendorDetails($id)
    {
        $user = User::findOrFail($id);
        $countries = Country::get(['id', 'name']);

        $deposit = collect([]);
        Deposit::where('user_id', $user->id)->with('currency')->get()->map(function ($q) use ($deposit) {
            $deposit->push((float) amountConv($q->amount, $q->currency));
        });
        $data['totalDeposit'] = $deposit->sum();

        $withdraw = collect([]);
        Withdrawals::where('user_id', $user->id)->with('currency')->get()->map(function ($q) use ($withdraw) {
            $withdraw->push((float) amountConv($q->amount, $q->currency));
        });
        $data['totalWithdraw'] = $withdraw->sum();

        return view('admin.vendor.details', compact('user', 'countries', 'data'));
    }
}
