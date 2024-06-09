<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\Generalsetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ManageCurrencyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $currencies = Currency::when($search,function($q) use($search){
            return $q->where('code','like',"%$search%")->orWhere('curr_name','like',"%$search%");
        })->orderBy('default','DESC')->paginate(20);
        return view('admin.currency.index',compact('currencies','search'));
    }

    public function addCurrency()
    {
        return view('admin.currency.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'curr_name'  => 'required',
            'code'       => 'required|max:4',
            'symbol'     => 'required|unique:currencies',
            'rate'       => 'required|gt:0',
            'default'    => 'required|in:1,0',
            'status'     => 'required|in:1,0'
        ],['curr_name.required'=>'Currency name is required.']);
       
        if($request->default){
            $default = Currency::where('default',1)->firstOrFail();
            $default->default = 0;
            $default->rate = round($request->rate,2);
            $default->save();

            $gs = Generalsetting::first();
            $gs->curr_code = $request->code;
            $gs->curr_sym = $request->symbol;
            Cache::forget('generalsettings');
            $gs->update();
        }
        $cuur = new Currency();
        $data['rate'] = round($request->rate,2);
        $cuur->save($data);
        return back()->with('success','New currency has been added');
    }

    public function editCurrency($id)
    {
        $currency = Currency::findOrFail($id);
        return view('admin.currency.edit',compact('currency'));
    }

    public function updateCurrency(Request $request,$id)
    {
        $data = $request->validate([
            'curr_name'  => 'required',
            'code'       => 'required|max:4',
            'symbol'     => 'required',
            'rate'       => 'required|gt:0',
            'default'    => 'in:1,0',
            'status'     => 'required|in:1,0'
        ]);
        
       
        $curr = Currency::findOrFail($id);
        if($request->default){
            $defaultCurr = Currency::where('default',1)->firstOrFail();
            $defaultCurr->default = 0;
            $defaultCurr->rate = round($request->rate,2);
            $defaultCurr->save();

            $gs = Generalsetting::first();
            $gs->curr_code = $curr->code;
            $gs->curr_sym = $request->symbol;
            Cache::forget('generalsettings');
            $gs->update();
        }

        $data['rate'] = round($request->rate,2);
        
        $curr->update($data);
        return back()->with('success','Currency has been updated');
    }

    public function deleteCurrency(Request $request)
    {
        $id = $request->id;
        $currency = Currency::findOrFail($id);
       
        if($currency->default == 1 || $currency->id == 1){
            return back()->with('error','This currency can not be deleted');
        }
        $currency->delete();
        return back()->with('success','Currency has been deleted');
    }

    
}
