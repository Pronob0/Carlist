<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Modal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModelController extends Controller
{
    public function index()
    {
        $models = Modal::orderby('id', 'desc')->paginate(15);
        $brands = Brand::where('status', 1)->get();
        return view('admin.model.index', compact('models', 'brands'));
    }
    public function store(Request $request)
    {

        $this->storeData($request, new Modal());
        return back()->with('success', __('Model added successfully'));
    }

    public function update(Request $request, $id)
    {
        $model = Modal::findOrFail($id);
        $this->storeData($request, $model, $id);
        return back()->with('success', __('Model updated successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:modals,name,' . $id,
            'brand_id' => 'required',
            
        ]);
        
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->status = $request->status;
        $data->brand_id = $request->brand_id;
        $data->save();

    }
    public function destroy(Request $request)
    {
        $model = Modal::findOrFail($request->id);
        $model->delete();
        return back()->with('success', __('Model deleted successfully'));
    }


}
