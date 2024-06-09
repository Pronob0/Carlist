<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
   
    public function index()
    {
        $categories = Category::orderby('id', 'desc')->paginate(15);
        return view('admin.category.index', compact('categories'));
    }
    public function store(Request $request)
    {

        $this->storeData($request, new Category());
        return back()->with('success', __('Category added successfully'));
    }

    public function update(Request $request, $id)
    {
        $bcategory = Category::findOrFail($id);
        $this->storeData($request, $bcategory, $id);
        return back()->with('success', __('Category updated successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            
        ]);
        
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->status = $request->status;
        
        $data->save();

    }
    public function destroy(Request $request)
    {
        $bcategory = Category::findOrFail($request->id);
        $bcategory->delete();
        return back()->with('success', __('Category deleted successfully'));
    }
}

