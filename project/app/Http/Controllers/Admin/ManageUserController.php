<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Models\Country;
use App\Models\Deposit;
use App\Models\LoginLogs;
use App\Models\Transaction;
use App\Models\Withdrawals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;

class ManageUserController extends Controller
{

    public function index()
    {
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
        $users = $users->where('is_vendor',0)->latest()->paginate(15);

        

        return view('admin.user.index', compact('users', 'search'));
    }


    public function create()
    {
        $countries = Country::get(['id', 'name', 'dial_code']);
        return view('admin.user.create', compact('countries'));
    }


    public function store(Request $request)
    {
        $gs = Generalsetting::first();
        

        $countries = Country::query();
        $name = $countries->pluck('name')->toArray();
        $data = $request->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', 'unique:users', $gs->allowed_email != null ? 'email_domain:' . $request->email : ''],
                'phone' => 'required',
                'country' => 'required|in:' . implode(',', $name),
                'address' => 'required',
                'password' => 'required|min:6|confirmed',
            ]

        );

        $currency = $countries->where('name', $request->country)->value('currency_id');
        $data['phone'] = $request->dial_code . $request->phone;
        $data['password'] = bcrypt($request->password);
        $data['email_verified'] = $gs->is_verify == 1;
        $user = User::create($data);



    
        return back()->with('success', 'User created successfully');
    }


    public function details($id)
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

        return view('admin.user.details', compact('user', 'countries', 'data'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required',
            'country' => 'required',
        ]);

        $user          = User::findOrFail($id);
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->phone   = $request->phone;
        $user->country = $request->country;
        $user->city    = $request->city;
        $user->zip     = $request->zip;
        $user->address = $request->address;
        $user->status  = $request->status ? 1 : 0;
        $user->email_verified  = $request->email_verified ? 1 : 0;
        $user->kyc_status  = $request->kyc_status ? 1 : 0;
        $user->update();

        return back()->with('success', 'User profile updated');
    }


    public function modifyBalance(Request $request)
    {
        $request->validate([
            
            'user_id'   => 'required',
            'amount'    => 'required|gt:0',
            'type'      => 'required|in:1,2'
        ]);
        $user  = User::findOrFail($request->user_id);
       
        if ($request->type == 1) {
            $user->balance += storePriceUSD($request->amount);
            $user->update();

            $trnx              = new Transaction();
            $trnx->trnx        = str_rand();
            $trnx->user_id     = $request->user_id;
            $trnx->currency_id = defaultCurrency()->id;
            $trnx->amount      = $request->amount;
            $trnx->charge      = 0;
            $trnx->remark      = 'add_balance';
            $trnx->type        = '+';
            $trnx->details     = trans('Balance added by system');
            $trnx->save();

            $msg = 'Balance has been added';

            @mailSend(
                'add_balance',
                [
                    'amount' => $request->amount,
                    'curr'  => defaultCurrency()->code,
                    'trnx'  => $trnx->trnx,
                    'after_balance' => showAdminAmount($user->balance),
                    'date_time'  => dateFormat($trnx->created_at)
                ],
                $user
            );
        }
        if ($request->type == 2) {
            $user->balance -= $request->amount;
            $user->update();

            $trnx              = new Transaction();
            $trnx->trnx        = str_rand();
            $trnx->user_id     = $request->user_id;
            $trnx->currency_id = defaultCurrency()->id;
            $trnx->amount      = $request->amount;
            $trnx->charge      = 0;
            $trnx->remark      = 'subtract_balance';
            $trnx->type        = '-';
            $trnx->details     = trans('Balance subtracted by system');
            $trnx->save();

            $msg = 'Balance has been subtracted';

            @mailSend(
                'subtract_balance',
                [
                    'amount' => $request->amount,
                    'curr'  => defaultCurrency()->code,
                    'trnx'  => $trnx->trnx,
                    'after_balance' => showAdminAmount($user->balance),
                    'date_time'  => dateFormat($trnx->created_at)
                ],
                $user
            );
        }

        return back()->with('success', $msg);
    }



    public function loginInfo($id)
    {
        $user = User::findOrFail($id);
        $loginInfo = LoginLogs::where('user_id', $id)->latest()->paginate(15);
        return view('admin.user.login_info', compact('loginInfo', 'user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        

        if($user->transactions->count() > 0){
            foreach ($user->transactions as $trnx) {
                $trnx->delete();
            }
        }

        if($user->deposits->count() > 0){
            foreach ($user->deposits as $deposit) {
                $deposit->delete();
            }
        }

        if($user->withdraws->count() > 0){
            foreach ($user->withdraws as $withdraw) {
                $withdraw->delete();
            }
        }



        if($user->tickets->count() > 0){
            foreach ($user->tickets as $ticket) {
                $ticket->delete();
            }
        }

        if($user->wistlists->count() > 0){
            foreach ($user->wistlists as $wish) {
                $wish->delete();
            }
        }



        $user->delete();
        return back()->with('success', 'User deleted');
    }



   
}
