<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConditionController extends Controller
{
    public function index()
    {
        $conditions = Condition::orderby('id', 'desc')->paginate(15);
        return view('admin.condition.index', compact('conditions'));
    }
    public function store(Request $request)
    {

        $this->storeData($request, new Condition());
        return back()->with('success', __('Condition added successfully'));
    }

    public function update(Request $request, $id)
    {
        $condition = Condition::findOrFail($id);
        $this->storeData($request, $condition, $id);
        return back()->with('success', __('Condition updated successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:conditions,name,' . $id,
            
        ]);
        
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->status = $request->status;
        
        $data->save();

    }
    public function destroy(Request $request)
    {
        $condition = Condition::findOrFail($request->id);
        $condition->delete();
        return back()->with('success', __('Condition deleted successfully'));
    }
}
