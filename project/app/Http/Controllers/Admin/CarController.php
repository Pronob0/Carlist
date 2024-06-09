<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Fuel;
use App\Models\Gallery;
use App\Models\Modal;
use App\Models\Transmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Twilio\Rest\Media;

class CarController extends Controller
{

    
    public function index()
    {
        $cars = Car::orderby('id', 'desc')->paginate(15);
        return view('admin.car.index', compact('cars'));

    }


    public function create(Request $request)
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $conditions = Condition::where('status', 1)->get();
        $models = Modal::where('status', 1)->get();
        $transmissions = Transmission::where('status', 1)->get();
        $fuels = Fuel::where('status', 1)->get();
        return view('admin.car.create', compact('categories', 'brands', 'conditions', 'models', 'transmissions', 'fuels'));
    }

    public function store(Request $request)
    {

        $request->validate([
           
            'title' => 'required|unique:cars|max:255',
            'category_id' => 'required',
            'condition_id' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'fuel_id' => 'required',
            'transmission_id' => 'required',
            'mileage' => 'required',
            'current_price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'video_image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_link1' => 'required',
            'video_link2' => 'required',
            'gallery*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       
            ]);
            
        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        $input['status'] = 1;
        $input['user_id'] = 
        $input['description'] = clean($request->description);
        if($request->hasFile('image')){
           
            $input['image'] = MediaHelper::handleMakeImage($input['image']);
        }
    
        if($request->hasFile('video_image1')){
            
            $input['video_image1'] = MediaHelper::handleMakeImage($input['video_image1']);
        }
    
        if($request->hasFile('video_image2')){
            
            $input['video_image2'] = MediaHelper::handleMakeImage($input['video_image2']);
        }
       
        $input['tags'] = $request->tags;

        if($request->meta_tag){
            $input['meta_tag'] = $request->meta_tag;
        }

        $specification_name = $request->specification_name;
        $specification_value = $request->specification_value;

        
        if ($request->specification_name != null && $request->specification_value != null) {
            $input['specification'] = json_encode(array_combine($specification_name, $specification_value));
        } else {
            $input['specification'] = null;
        }

        $car = Car::create($input);
        $gallery = $request->file('gallery');
        if ($gallery) {
            foreach ($gallery as $file) {
                $gallery = new Gallery();
                $gallery->car_id = $car->id;
                $gallery->image = MediaHelper::handleMakeImage($file);
                $gallery->save();
            }
        }
        
        return redirect()->route('admin.car.index')->with('success', 'Car created successfully');
}


    public function edit($id)
    {
        $car = Car::find($id);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $conditions = Condition::where('status', 1)->get();
        $models = Modal::where('status', 1)->get();
        $transmissions = Transmission::where('status', 1)->get();
        $fuels = Fuel::where('status', 1)->get();

        if($car->specification != null){
            $specification = json_decode($car->specification);
        }
        else{
            $specification = null;
        }

        return view('admin.car.edit', compact('car', 'categories', 'brands', 'conditions', 'models', 'transmissions', 'fuels', 'specification'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|max:255|unique:cars,title,' . $id,
            'category_id' => 'required',
            'condition_id' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'fuel_id' => 'required',
            'transmission_id' => 'required',
            'mileage' => 'required',
            'current_price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'video_image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_link1' => 'required',
            'video_link2' => 'required',
            'gallery*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        $input['status'] = 1;
        if($request->hasFile('image')){
            $input['image'] = MediaHelper::handleUpdateImage($input['image'], 'image');
        }
        if($request->hasFile('video_image1')){
            $input['video_image1'] = MediaHelper::handleUpdateImage($input['video_image1'], 'video_image1');
        }
        if($request->hasFile('video_image2')){
            $input['video_image2'] = MediaHelper::handleUpdateImage($input['video_image2'], 'video_image2');
        }
        $input['tags'] = tagFormat($request->tags);

        if($request->meta_tag){
            $input['meta_tag'] = tagFormat($request->meta_tag);
        }

        $input['user_id'] = 0;
        $specification_name = $request->specification_name;
        $specification_value = $request->specification_value;

        if ($request->specification_name != null && $request->specification_value != null) {
            $input['specification'] = json_encode(array_combine($specification_name, $specification_value));
        } else {
            $input['specification'] = null;
        }

        $car = Car::find($id);
        $car->update($input);
        $gallery = $request->file('gallery');
        if ($gallery) {
            foreach ($gallery as $file) {
                $gallery = new Gallery();
                $gallery->car_id = $car->id;
                $gallery->image = MediaHelper::handleUpdateImage($file, 'gallery');
                $gallery->save();
            }
        }

        return redirect()->route('admin.car.index')->with('success', 'Car updated successfully');

    }

    public function deleteGallery(Request $request)
    {
        $gallery = Gallery::find($request->id);

        if ($gallery) {
             MediaHelper::handleDeleteImage($gallery->image);
            
        }
        $gallery->delete();
        return redirect()->back()->with('success', 'Gallery image deleted successfully');
    }


    public function destroy(Request $request)
    {
        $car = Car::find($request->id);
        if ($car) {
            MediaHelper::handleDeleteImage($car->image);
            MediaHelper::handleDeleteImage($car->video_image1);
            MediaHelper::handleDeleteImage($car->video_image2);
            $gallery = Gallery::where('car_id', $car->id)->get();
            foreach ($gallery as $item) {
                MediaHelper::handleDeleteImage($item->image);
                $item->delete();
            }
            $car->delete();
            return redirect()->back()->with('success', 'Car deleted successfully');
        }
    }

    public function publish(Request $request)
    {
        $cars = Car::where('status', 1)->paginate(15);
        return view('admin.car.publish', compact('cars'));
        
    }

    public function pending(Request $request)
    {
        $cars = Car::where('status', 0)->paginate(15);
        return view('admin.car.pending', compact('cars'));
        
    }

    public function featured (Request $request)
    {
        $cars = Car::where('is_feature', 1)->paginate(15);
        return view('admin.car.feature', compact('cars'));
        
    }

    public function reject(){
        $cars = Car::where('status', 2)->paginate(15);
        return view('admin.car.reject', compact('cars'));
    }


        
            

}
