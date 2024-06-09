<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarResources;
use App\Http\Resources\VendorCarResources;
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

    public function __construct()
    {
        if(auth()->user()){
            if(auth()->user()->is_vendor != 1){
                return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "You are not authorized to access this page."]]);
            }
    }
        
    }
    public function index(){
        $data['categories'] = Category::where('status', 1)->select('id','name','slug')->get();
        $data['brands'] = Brand::where('status', 1)->select('id','name','slug')->get();
        $data['conditions'] = Condition::where('status', 1)->select('id','name','slug')->get();
        $data['models'] = Modal::where('status', 1)->select('id','name','slug')->get();
        $data['transmissions'] = Transmission::where('status', 1)->select('id','name','slug')->get();
        $data['fuels'] = Fuel::where('status', 1)->select('id','name','slug')->get();
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function store(Request $request)
    {
       

        $validator = Validator::make($request->all(), [
           
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

        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }
            
        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        $input['status'] = 1;
        if(auth()->user()->is_vendor == 1){
            $input['user_id'] = auth()->user()->id;
        }
        
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
       
        $input['tags'] = tagFormat($request->tags);

        if($request->meta_tag){
            $input['meta_tag'] = tagFormat($request->meta_tag);
        }

        $specification_name = $request->specification_name;

        $specification_value = $request->specification_value;
        if ($request->specification_name != null && $request->specification_value != null) {
            $input['specification'] = json_encode(array_combine($specification_name, $specification_value));
        } else {
            $input['specification'] = null;
        }

        if (strlen($input['specification']) > 1500) {
            return "Specification is too long";
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

        return response()->json(['status' => true, 'data' => $car, 'error' => []]);


    }


    public function allCars(){
        $cars = Car::where('user_id', auth()->user()->id)->select('title','slug', 'brand_id','model_id','mileage','is_feature','status')->paginate(10);
        $data['cars'] = VendorCarResources::collection($cars)->response()->getData(true);
        return response()->json(['status' => true, 'data' => $data['cars'], 'error' => []]);
        

    }

    public function pendingCars(){
        $cars = Car::where('user_id', auth()->user()->id)->where('status', 0)->select('title','slug', 'brand_id','model_id','mileage','is_feature','status')->paginate(10);
    
        $data['cars'] = VendorCarResources::collection($cars)->response()->getData(true);
        return response()->json(['status' => true, 'data' => $data['cars'], 'error' => []]);

    }

    public function activeCars(){
        $cars = Car::where('user_id', auth()->user()->id)->where('status', 1)->select('title','slug', 'brand_id','model_id','mileage','is_feature','status')->paginate(10);
        $data['cars'] = VendorCarResources::collection($cars)->response()->getData(true);
        return response()->json(['status' => true, 'data' => $data['cars'], 'error' => []]);
    }

    public function rejectedCars(){
        $cars = Car::where('user_id', auth()->user()->id)->where('status', 2)->select('title','slug', 'brand_id','model_id','mileage','is_feature','status')->paginate(10);
        $data['cars'] = VendorCarResources::collection($cars)->response()->getData(true);
        return response()->json(['status' => true, 'data' => $data['cars'], 'error' => []]);
    }


    public function soldCars(){
        $cars = Car::where('user_id', auth()->user()->id)->where('status', 3)->select('title','slug', 'brand_id','model_id','mileage','is_feature','status')->paginate(10);
        $data['cars'] = VendorCarResources::collection($cars)->response()->getData(true);
        return response()->json(['status' => true, 'data' => $data['cars'], 'error' => []]);
    }


    public function featuredCars(){
        $cars = Car::where('user_id', auth()->user()->id)->where('is_feature', 1)->select('title','slug', 'brand_id','model_id','mileage','is_feature','status')->paginate(10);
        $data['cars'] = VendorCarResources::collection($cars)->response()->getData(true);
        return response()->json(['status' => true, 'data' => $data['cars'], 'error' => []]);
    }

    public function editCar($slug){
        $car = Car::where('slug', $slug)->first();
        if($car->user_id != auth()->user()->id){
            return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "You are not authorized to access this page."]]);
        }
        $data['car'] = $car;
        $data['categories'] = Category::where('status', 1)->select('id','name','slug')->get();
        $data['brands'] = Brand::where('status', 1)->select('id','name','slug')->get();
        $data['conditions'] = Condition::where('status', 1)->select('id','name','slug')->get();
        $data['models'] = Modal::where('status', 1)->select('id','name','slug')->get();
        $data['transmissions'] = Transmission::where('status', 1)->select('id','name','slug')->get();
        $data['fuels'] = Fuel::where('status', 1)->select('id','name','slug')->get();
        $data['specification'] = json_decode($car->specification);
        $data['gallery'] = Gallery::where('car_id', $car->id)->get();
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function updateCar(Request $request, $slug){

        
        $car = Car::where('slug', $slug)->first();
        
        if($car->user_id != auth()->user()->id){
            return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "You are not authorized to access this page."]]);
        }
        
        $validator = Validator::make($request->all(), [
           
            'title' => 'required|max:255|unique:cars,title,'.$car->id,
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

        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }
        

        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        $input['status'] = 1;
        if(auth()->user()->is_vendor == 1){
            
            $input['user_id'] = auth()->user()->id;
        }
        $input['description'] = clean($request->description);
        if($request->hasFile('image')){
            MediaHelper::handleDeleteImage($car->image);
            $input['image'] = MediaHelper::handleUpdateImage($request->image, $car->image);

        }

        if($request->hasFile('video_image1')){
            MediaHelper::handleDeleteImage($car->video_image1);
            $input['video_image1'] = MediaHelper::handleUpdateImage($request->video_image1, $car->video_image1);
        }

        if($request->hasFile('video_image2')){
            MediaHelper::handleDeleteImage($car->video_image2);
            $input['video_image2'] = MediaHelper::handleUpdateImage($request->video_image2, $car->video_image2);
        }

        $input['tags'] = tagFormat($request->tags);

        if($request->meta_tag){
            $input['meta_tag'] = tagFormat($request->meta_tag);
        }

        $specification_name = $request->specification_name;
        $specification_value = $request->specification_value;

        if ($request->specification_name != null && $request->specification_value != null) {
            $input['specification'] = json_encode(array_combine($specification_name, $specification_value));
        } else {
            $input['specification'] = null;
        }

        if (strlen($input['specification']) > 1500) {
            return "Specification is too long";
        }

        $car->update($input);
        $gallery = $request->file('gallery');
        if ($gallery) {
            foreach ($gallery as $file) {
                $gallery = new Gallery();
                $gallery->car_id = $car->id;
                $gallery->image = MediaHelper::handleMakeImage($file);
                $gallery->save();
            }
        }
        $data['car'] = $car;
        $data['gallery'] = Gallery::where('car_id', $car->id)->get();

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);


    }

}
