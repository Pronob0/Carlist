<?php

namespace App\Http\Controllers\Vendor;

use App\Classes\GoogleAuthenticator;
use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\KycForm;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Models\Car;

class DashboardController extends Controller
{
    public function __construct()
    {
        if(auth()->user()){
            if(auth()->user()->is_vendor != 1){
                return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "You are not authorized to access this page."]]);
            }
    }
        
    }

    public function dashboard()
    {
        $data['total_car'] = Car::where('user_id', auth()->user()->id)->count();
        $data['featured_car'] = Car::where('user_id', auth()->user()->id)->where('is_feature', 1)->count();
        $data['active_car'] = Car::where('user_id', auth()->user()->id)->where('status', 1)->count();
        $data['inactive_car'] = Car::where('user_id', auth()->user()->id)->where('status', 0)->count();
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function kycForm()
    {
        if (auth()->user()->kyc_status == 2)
            return response()->json(['status' => false, 'data' => [], 'error' => 'You have already submitted the KYC data.']);
        if (auth()->user()->kyc_status == 1)
            return response()->json(['status' => false, 'data' => [], 'error' => 'Your KYC data is already verified.']);
        $success['kyc_form_data'] = KycForm::get();
        return response()->json(['status' => true, 'data' => $success, 'error' => []]);
    }

    public function kycFormSubmit(Request $request)
    {
        if (auth()->user()->kyc_status == 2)
            return response()->json(['status' => false, 'data' => [], 'error' => 'You have already submitted the KYC data.']);
        if (auth()->user()->kyc_status == 1)
            return response()->json(['status' => false, 'data' => [], 'error' => 'Your KYC data is already verified.']);

        $data = $request->except('_token');
        $kycForm = KycForm::get();
        $rules = [];
        foreach ($kycForm as $value) {
            if ($value->required == 1) {
                if ($value->type == 2) {
                    $rules[$value->name] = 'required|image|mimes:png,jpg,jpeg|max:5120';
                }
                $rules[$value->name] = 'required';
            }

            if ($value->type == 2) {
                $rules[$value->name] = 'image|mimes:png,jpg,jpeg|max:5120';
                if (request("$value->name")) {
                    $filename = MediaHelper::handleMakeImage(request("$value->name"));
                }
                unset($data[$value->name]);
                $data['image'][$value->name] = $filename;
            }

            if ($value->type == 3) {
                unset($data[$value->name]);
                $data['details'][$value->name] = request("$value->name");
            }
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }
        $user = auth()->user();
        $user->kyc_info = $data;
        $user->kyc_status = 2;
        $user->save();

        return response()->json(['status' => true, 'data' => [ 'message' => 'Your KYC data has been submitted successfully.']]);
    }


    public function kycShow()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $success['username'] = $user->name;
        if ($user->kyc_status == 0)
            return response()->json(['status' => false, 'data' => [], 'error' => ['Your KYC data is not submitted yet.']]);
        if ($user->kyc_status == 1)
            $message =  'Your KYC data is verified.';
        $success['user_info'] = $user->kyc_info;
        foreach ($user->kyc_info['image'] as $key => $value) {
            $success['user_info']['image'][$key] = getPhoto($value);
        }
        return response()->json(['status' => true, 'data' => $success, 'error' => ['Your KYC data is verified.']]);
    }

    public function transactions()
    {
        $remark = request('remark');
        $search = request('trnx');
        $user = auth()->user();
        $success['transactions'] = Transaction::where('user_id', $user->id)
            ->when($remark, function ($q) use ($remark) {
                return $q->where('remark', $remark);
            })
            ->when($search, function ($q) use ($search) {
                return $q->where('trnx', $search);
            })

            ->latest()
            ->paginate(10)
            ->through(function ($data) {
                $data['amount'] = round($data['amount'], 2);
                $data['charge'] = round($data['charge'], 2);
                $data['update_created_at'] = Carbon::parse($data->created_at)->format('d M Y');
                return $data;
            });



        $remarkList = [
            ['value' => 'any', 'label' => 'Any'],
            ['value' => 'withdraw_money', 'label' => 'Withdraw Money'],
            ['value' => 'bidding', 'label' => 'Bidding'],
            ['value' => 'winning', 'label' => 'Winning'],
            ['value' => 'refund', 'label' => 'Refund'],
            ['value' => 'add_balance', 'label' => 'Add Balance'],
            ['value' => 'subtract_balance', 'label' => 'Subtract Balance']
        ];
        $success['remark_list'] =  $remarkList;
        $success['post_balance'] = $user->balance;
        $success['remark'] = $remark;
        $success['search'] = $search;

        return response()->json(['status' => true, 'data' => $success, 'error' => []]);
    }

    public function trxDetails($id)
    {
        $user = auth()->user();
        $success['transaction'] = Transaction::where('id', $id)->where('user_id', $user->id)->first();
        if (!$success['transaction']) {
            return response()->json(['status' => false, 'data' => [], 'error' => 'Transaction not found']);
        }
        return response()->json(['status' => true, 'data' => $success, 'error' => []]);
    }

    public function getDetails()
    {

        $user = auth()->user();
        $success['user'] = $user;
        $success['user']['photo'] = getPhoto($user->photo);
        $success['user']['social_link'] =  json_decode($user->social_link);
        return response()->json(['status' => true, 'data' => $success, 'error' => []]);
    }

    public function profileSubmit(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            // 'photo' => 'mimes:jpeg,jpg,png,PNG,JPG',
        ]);

        $user          = auth()->user();
        $user->name    = $request->name;
        $user->username = $request->username;
        $user->email   = $request->email;
        $user->phone   = $request->phone;
        $user->address = $request->address;
        $user->zip     = $request->zip;
        $user->city    = $request->city;
        $user->country    = $request->country;

        if ($request->hasFile('photo')) {
            $user->photo =  MediaHelper::handleUpdateImage($request['photo'], $user->photo);
        }
        $user->update();

        return response()->json(['status' => true, 'data' => new UserResource($user) , 'message' => 'Profile updated successfully']);
    }

    public function changePass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_pass' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }

        $user = auth()->user();


        if (Hash::check($request->old_pass, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->update();
            return response()->json(['status' => true, 'data' => [], 'message' => 'Password changed successfully']);
        }
        return response()->json(['status' => false, 'data' => [], 'error' => 'Old password does not match']);
    }

 

    public function twoFactor()
    {
        $gnl = Generalsetting::first();
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->name . '@' . $gnl->title, $secret);
        $prevcode = $user->two_fa_code;
        $prevqr = $ga->getQRCodeGoogleUrl($user->name . '@' . $gnl->title, $prevcode);

        return response()->json(['status' => true, 'data' => ['secret' => $secret, 'qrCodeUrl' => $qrCodeUrl, 'prevcode' => $prevcode, 'prevqr' => $prevqr],'two_fa'=>$user->two_fa, 'error' => []]);
    }

    public function createTwoFactor(Request $request)
    {

        $user = auth()->user();

        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);

        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);


        if ($oneCode == $request->code) {
            $user->two_fa_code = $request->key;
            $user->two_fa = 1;
            $user->two_fa_status = 1;
            $user->save();

            return response()->json(['status' => true, 'data' => [], 'success' => 'Two factor authentication enabled successfully']);
        } else {
            return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid verification code']);
        }
    }

    public function disableTwoFactor(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'code' => 'required',
        ]);

        $ga = new GoogleAuthenticator();
        $secret = $user->two_fa_code;
        $oneCode = $ga->getCode($secret);

        if ($oneCode == $request->code) {

            $user->two_fa = 0;
            $user->two_fa_status = 0;
            $user->two_fa_code = null;
            $user->save();


            return response()->json(['status' => true, 'data' => [], 'success' => 'Two factor authentication disabled successfully']);
        } else {
            return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid verification code']);
        }
    }


    public function otp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);
        $user = auth()->user();
        $googleAuth = new GoogleAuthenticator();
        $otp =  $request->otp;

        $secret = $user->two_fa_code;
        $oneCode = $googleAuth->getCode($secret);
        $userOtp = $otp;
        if ($oneCode == $userOtp) {
            $user->verified = 1;
            $user->save();
            return response()->json(['status' => true, 'data' => [], 'success' => 'OTP verified successfully']);
        } else {
            return response()->json(['status' => false, 'data' => [], 'error' => 'Invalid OTP']);
        }
    }

    public function socialLink(Request $request)
    {
        $user = auth()->user();
        $facebook = ['status' => $request->status, 'link' => $request->facebook];
        $twitter = ['status' => $request->status, 'link' => $request->twitter];
        $linkedin = ['status' => $request->status, 'link' => $request->linkedin];
        $pinterest = ['status' => $request->status, 'link' => $request->linkedin];
        $instagram = ['status' => $request->status, 'link' => $request->instagram];
        $user->social_link = ['facebook' => $facebook, 'twitter' => $twitter, 'linkedin' => $linkedin, 'pinterest' => $pinterest, 'instagram' => $instagram];
        $user->save();

        $data['social_link'] = $user->social_link;
        return response()->json(['status' => true, 'data' => $data , 'success' => 'Social links updated successfully']);
        

    }
}
