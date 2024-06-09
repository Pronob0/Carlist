<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutTable;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function aboutUs(){

        $about = About::first();
        $tables = AboutTable::all();
        return view('admin.about.index',compact('about','tables'));
    }

    public function update(Request $request){

        $data = $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif',
            'title' => 'required',
            'subtitle' => 'required',
            'video_link' => 'required',
        ]);

        $about = About::first();
        $about->title = $data['title'];
        $about->subtitle = $data['subtitle'];
        $about->video_link = $data['video_link'];

        if($request->hasFile('image')){
            
            $about->image = MediaHelper::handleUpdateImage($request->image, $about->image);
        }

        $about->save();

        return redirect()->back()->with('success','About us updated successfully');

    }

    public function addTable(Request $request){

        $data = $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
            'subtitle' => 'required',
        ]);

        $data['image'] = MediaHelper::handleMakeImage($request->image);
        AboutTable::create($data);

        return redirect()->back()->with('success','Table added successfully');
    }


    public function updateTable(Request $request){

        $data = $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
            'subtitle' => 'required',
        ]);

        $table = AboutTable::find($request->id);

        $table->title = $data['title'];
        $table->subtitle = $data['subtitle'];

        if($request->hasFile('image')){
            $table->image = MediaHelper::handleUpdateImage($request->image, $table->image);
        }

        $table->update();

        return redirect()->back()->with('success','Table updated successfully');
    }

    public function deleteTable(Request $request){

        $table = AboutTable::find($request->key);

        if($table){
            MediaHelper::handleDeleteImage($table->image);
        }

        $table->delete();

        return redirect()->back()->with('success','Table deleted successfully');
    }
}
