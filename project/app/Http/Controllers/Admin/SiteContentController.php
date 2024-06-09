<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Traits\ContentRules;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    use ContentRules;

    public function index()
    {
        $sections = SiteContent::get();
        return view('admin.site_contents.index',compact('sections'));
    }
    public function edit($id)
    {
        $section = SiteContent::findOrFail($id);
        return view('admin.site_contents.'.$section->slug,compact('section'));
    }

   
    public function contentUpdate(Request $request,$id)
    { 
        $content = SiteContent::findOrFail($id);
        $rules   = trim($content->slug);
    
        $data    = $request->validate($this->$rules());
        $old     = $content->content;

        if(@$old->image) $data['image'] = @$old->image;
        if($request->image){
            $size = explode('x',$request->image_size);
            $data['image'] = MediaHelper::handleUpdateImage($request->image,@$old->image,[$size[0],$size[1]]);
        }

        if(@$old->image_two) $data['image_two'] = @$old->image_two;
        if($request->image_two){
            $size = explode('x',$request->image_size);
            $data['image_two'] = MediaHelper::handleUpdateImage($request->image_two,@$old->image_two,[$size[0],$size[1]]);
        }
        // background
        if(@$old->background) $data['background'] = @$old->background;
        if($request->background){
            $size = explode('x',$request->background_size);
            $data['background'] = MediaHelper::handleUpdateImage($request->background,@$old->background,[$size[0],$size[1]]);
        }

    
        if($request->phone){
            $data['phone'] = json_encode($request->phone);
        }

        if($request->email){
            $data['email'] = json_encode($request->email);
        }

        $content->content = $data;
        $content->update();

        return back()->with('success','Data updated successfully');
    }
    
    public function subContentUpdate(Request $request,$id)
    {
        $content = SiteContent::findOrFail($id);
        $rules   = trim($content->slug).'_subcontent';
        $data    = $request->validate($this->$rules());
        $subContent = $content->sub_content;

        if($request->image){
            $size = explode('x',$request->image_size);
            $data['image'] = MediaHelper::handleUpdateImage($request->image,@$subContent->image,[$size[0],$size[1]]);
        }

        if($subContent == null){
            $subContent = [];
        } 
     

        array_push($subContent,$data);
        $content->sub_content = $subContent;
        $content->update();

        return back()->with('success','Subcontent added successfully');
    }
    

    public function subContentUpdateSingle(Request $request)
    {
        $content = SiteContent::findOrFail($request->section);
     
        $rules   = trim($content->slug).'_subcontent';
        $data    = $request->validate($this->$rules());
        $old     = $content->sub_content[$request->sub_key];
     
        if(isset($data['description'])) $data['description'] = clean($data['description']);
      
        if(@$old->image) $data['image'] = $old->image;
        if($request->image){
            $size = explode('x',$request->image_size);
            $data['image'] = MediaHelper::handleUpdateImage($request->image,@$old->image,[$size[0],$size[1]]);
        }

        $replacements         = array($request->sub_key => $data);
        $newData              = json_decode(json_encode(array_replace($content->sub_content, $replacements)));
        $content->sub_content = $newData;
        $content->update();
        return back()->with('success','Data updated successfully');
    }

    public function subContentRemove(Request $request)
    {
        $content = SiteContent::findOrFail($request->section);
        $full = $content->sub_content;
        $old     = $content->sub_content[$request->key];
        
        if(@$old->image) MediaHelper::handleDeleteImage($old->image);
        unset($full[$request->key]);
        
        $content->sub_content = $full;

        $content->save();

        return back()->with('success','Data removed successfully');
        
    }

    public function statusUpdate(Request $request)
    {
        $content = SiteContent::find($request->id);
        if ($content->slug == 'banner') return response()->json(['error' => __('Banner status can not be changed')]);
        if(!$content) return response()->json(['error' => __('Section not found')]);
        
        if($content->status == 1) {
            $content->status = 0;
            $msg = ucfirst($content->name).' section is turned off';
        } else {
            $content->status = 1;
            $msg = ucfirst($content->name).' section is turned on';
        }

        $content->update();
        return response()->json(['success'=> __($msg)]);
    }
}
