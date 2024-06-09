<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use HTMLPurifier;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;


class PageController extends Controller
{

   
    public function index()
    {
        $pages = Page::get();
        return view('admin.page.index',compact('pages'));
    }

  
    public function create()
    {
        return view('admin.page.create');
    }
    public function store(PageRequest $request)
    {
        $page = new Page();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->details = clean($request->details);
        $page->type = 'true';
        $page->save();
        return back()->with('success',__('Page created successfully'));
    }

  
    public function edit(Page $page)
    {
        return view('admin.page.edit',compact('page'));
    }
    
    public function update(PageRequest $request, Page $page)
    {
        
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->details = clean($request->details);
        $page->type = 'true';

        if($page->id == 13){

            if(isset($request->image)){
                $status = MediaHelper::ExtensionValidation($request->image);
                if(!$status){
                    return ['errors' => [0=>'file format not supported']];
                }
                $page->image = MediaHelper::handleUpdateImage($request->image,$page->image);
            }


            $page->header_title = $request->header_title;
            $page->header_subtitle = $request->header_subtitle;
            $page->video = $request->video;

        }
       
        
        $page->update();
        return back()->with('success',__('Page updated successfully'));
    }

    public function destroy(Request $request)
    {
        Page::findOrFail($request->id)->delete();
        return back()->with('success',__('Page deleted successfully'));
    }
}
