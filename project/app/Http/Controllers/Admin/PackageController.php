<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::paginate(15);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:packages',
            'price' => 'required',
            'term' => 'required',
            'number_of_car_add' => 'required',
            'number_of_car_featured' => 'required',
            'status' => 'required',
            
        ]);

        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        Package::create($input);

        return redirect()->route('admin.package.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'title' => 'required|unique:packages,title,' . $package->id . ',id',
            'price' => 'required',
            'term' => 'required',
            'number_of_car_add' => 'required',
            'number_of_car_featured' => 'required',
            'status' => 'required',
            
        ]);

        $input = $request->all();
        $input['slug'] = Str::slug($request->title);

        $package->update($input);

        return redirect()->route('admin.package.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.package.index')->with('success', 'Package deleted successfully.');
    }


}
