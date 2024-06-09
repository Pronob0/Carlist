<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderSection;
use Illuminate\Http\Request;

class HeaderSectionController extends Controller
{
    public function index()
    {
        $header= HeaderSection::first();
        return view('admin.site_contents.header_section',compact('header'));
    }

    public function update(Request $request)
    {
        $header= HeaderSection::first();
        $header->update($request->except('_token'));
        return back()->with('success','Header Section Updated Successfully');
    }


}
