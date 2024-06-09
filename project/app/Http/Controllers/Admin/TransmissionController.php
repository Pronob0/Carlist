<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransmissionController extends Controller
{
    public function index()
    {
        $transmissions = Transmission::orderby('id', 'desc')->paginate(15);
        return view('admin.transmission.index', compact('transmissions'));
    }
    public function store(Request $request)
    {

        $this->storeData($request, new Transmission());
        return back()->with('success', __('Transmission added successfully'));
    }

    public function update(Request $request, $id)
    {
        $transmission = Transmission::findOrFail($id);
        $this->storeData($request, $transmission, $id);
        return back()->with('success', __('Transmission updated successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:modals,name,' . $id,
            
        ]);
        
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->status = $request->status;
        $data->save();

    }
    public function destroy(Request $request)
    {
        $model = Transmission::findOrFail($request->id);
        $model->delete();
        return back()->with('success', __('Transmission deleted successfully'));
    }
}
