<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fuel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::orderby('id', 'desc')->paginate(15);
        return view('admin.fuel.index', compact('fuels'));
    }
    public function store(Request $request)
    {

        $this->storeData($request, new Fuel());
        return back()->with('success', __('Fuel added successfully'));
    }

    public function update(Request $request, $id)
    {
        $fuel = Fuel::findOrFail($id);
        $this->storeData($request, $fuel, $id);
        return back()->with('success', __('Fuel updated successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:fuels,name,' . $id,
        ]);
        
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->status = $request->status;
        $data->save();

    }
    public function destroy(Request $request)
    {
        $fuel = Fuel::findOrFail($request->id);
        $fuel->delete();
        return back()->with('success', __('Fuel deleted successfully'));
    }
}
