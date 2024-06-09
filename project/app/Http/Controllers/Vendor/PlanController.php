<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct()
    {
        if(auth()->user()){
            if(auth()->user()->is_vendor != 1){
                return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "You are not authorized to access this page."]]);
            }
    }
        
    }
    public function pricingPlan(){
    $data['pricing'] = Package::where('status', 1)->get();
    return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }
}
