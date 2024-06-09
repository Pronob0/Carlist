<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {

        $brands = Brand::orderby('id', 'desc')->paginate(15);
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $this->storeData($request, new Brand());
        return back()->with('success', 'Brand has been created');
    }

    public function edit(Brand $brand)
    {

        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $this->storeData($request, $brand, $brand->id);
        return back()->with('success', 'Category has been updated');
    }


    public function storeData($request, $data, $id = null)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $id,
            'status' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $data->name = $request->name;
        $data->slug = Str::slug($request->name);

        $data->status = $request->status;
        if (isset($request['image'])) {
            $status = MediaHelper::ExtensionValidation($request['image']);
            if (!$status) {
                return ['errors' => [0 => 'file format not supported']];
            }
            if ($id) {
                $data->image = MediaHelper::handleUpdateImage($request['image'], $data->image);
            } else {
                $data->image = MediaHelper::handleMakeImage($request['image']);
            }
        }
        $data->save();
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
       

        foreach ($brand->models as $model) {
           
            $model->delete();
        }

        $brand->delete();
        return back()->with('success', 'Brand has been deleted');
    }
}
