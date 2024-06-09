<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResources;
use App\Http\Resources\VendorResource;
use App\Models\About;
use App\Models\AboutTable;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Fuel;
use App\Models\Gallery;
use App\Models\Modal;
use App\Models\Package;
use App\Models\SiteContent;
use App\Models\Transmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function aboutUs(){

      $about = SiteContent::where('slug', 'about')->first();
        $oldcontent = $about->content;
        $oldcontent= json_decode(json_encode($oldcontent,true),true);
        $oldcontent['image'] = asset("assets/images/".$oldcontent['image']);
        $about->content = $oldcontent;
        $data['content'] = $about->content;
        // subcontent images change 
        $subcontent = $about->sub_content;
        $subcontent = json_decode(json_encode($subcontent,true),true);
        foreach($subcontent as $key => $value){
            $subcontent[$key]['image'] = asset("assets/images/".$value['image']);
        }
        $about->sub_content = $subcontent;
        $data['sub_content'] = $about->sub_content;


        $data['about_second_section'] = About::first();
        $data['about_second_section']->image = asset('assets/images/'.$data['about_second_section']->image);
        $data['about_table_second'] = AboutTable::get();
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
       
    }

    public function contactUs(){
        
        $data = SiteContent::where('slug', 'contact')->first();
       $data['phone'] = json_decode($data->content->phone) ;
       $data['email'] = json_decode($data->content->email) ;
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function contactSubmit(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'subject' => 'required',
      'message' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'data' => [], 'error' =>  $validator->errors()->first()]);
    }

    $contact = SiteContent::where('slug', 'contact')->firstOrFail();
    $contact = (json_decode($contact->content->email));
    
    try {
      @email([
        'name' => 'Admin',
        'subject' => 'Contact',
        'email'  => $contact[0],
        'message' => "One contact query is for you.<br><br> <b>Customer Details</b> <br><br> Name : $request->name. <br><br> Email : $request->email. <br><br>  Subject : $request->subject. <br><br> Message : <br><br> $request->message."
      ]);
      return response()->json(['status' => true, 'data' => [], 'success' =>  'Your query has been submitted successfully']);
    } catch (\Throwable $th) {

      return response()->json(['status' => false, 'data' => [], 'error' =>  'Something went wrong']);
    }
  }

  public function cars(Request $request){
    
    $data['categories'] = Category::where('status', 1)->get();
    $data['fuel'] = Fuel::where('status', 1)->get();
    $data['model'] = Modal::where('status', 1)->get();
    $data['condition'] = Condition::where('status', 1)->get();
    $data['brand'] = Brand::where('status', 1)->get();
    $data['image_url']= asset('assets/images/');
    $data['transmission'] = Transmission::where('status', 1)->get();

    $category = $request->has('category') ? $request->category : '';
    $brand = $request->has('brand') ? $request->brand : '';
    $model = $request->has('model') ? $request->model : '';
    $fuel = $request->has('fuel') ? $request->fuel : '';
    $condition = $request->has('condition') ? $request->condition : '';
    $transmission = $request->has('transmission') ? $request->transmission : '';
    $max_price = $request->has('max_price') ? $request->max_price : '';
    $min_price = $request->has('min_price') ? $request->min_price : '';
    // sort by hightolow or lowtohigh or latest or oldest 
    $sort = $request->has('sort') ? $request->sort : 'latest'; 


    

    $cars = Car:: where('status', 1) -> when($category, function ($query, $category) {
      return $query->where('category_id', $category);
    }) 
    -> when($brand, function ($query, $brand) {
      return $query->where('brand_id', $brand);
    }) 
    -> when($model, function ($query, $model) {
        return $query->where('model_id', $model);
    })
    -> when($fuel, function ($query, $fuel) {
        return $query->where('fuel_id', $fuel);
    })
    -> when($condition, function ($query, $condition) {
        return $query->where('condition_id', $condition);
    })
    -> when($transmission, function ($query, $transmission) {
        return $query->where('transmission_id', $transmission);
    })
    -> when($max_price, function ($query, $max_price) {
        return $query->where('current_price', '<=', $max_price);
    })
    -> when($min_price, function ($query, $min_price) {
        return $query->where('current_price', '>=', $min_price);
    })
    -> when($sort, function ($query, $sort) {
        if($sort == 'hightolow'){
            return $query->orderBy('current_price', 'desc');
        }
        if($sort == 'lowtohigh'){
            return $query->orderBy('current_price', 'asc');
        }
        if($sort == 'latest'){
            return $query->orderBy('id', 'desc');
        }
        if($sort == 'oldest'){
            return $query->orderBy('id', 'asc');
        }
    })
    // with gallery 
    -> paginate(10);

    $data['cars'] = CarResources::collection($cars)->response()->getData(true);

    return response()->json(['status' => true, 'data' => $data, 'error' => []]);

  }

  public function blogs(Request $request)
  {

    $cate = BlogCategory::where('slug', $request->category)->first();
    $tag = $request->tag;


    $data['categories'] = BlogCategory::where('status', 1)->get();
    // get tags all field pluck 
    $tags= [];
    $blogs = Blog::where('status', 1)->get();
    foreach ($blogs as $blog) {
      $tags = array_merge($tags, explode(',', $blog->tags));
    }
    $data['tags'] = array_unique($tags);
    $data['blogs'] = Blog::where('status', 1)
      ->when($cate, function ($query, $cate) {
        return $query->where('category_id', $cate->id);
      })
        ->when($tag, function ($query, $tag) {
            return $query->where('tags', 'like', '%' . $tag . '%');
        })
      ->orderBy('id', 'desc')->paginate(6);

    return response()->json(['status' => true, 'data' => $data, 'error' => []]);
  }

  public function blogDetails($slug)
  {
    $data['blog'] = Blog::where('slug', $slug)->first();
    $data['categories'] = BlogCategory::where('status', 1)->get();
    $data['tags'] = explode(',', $data['blog']->tags);
    $data['image_url']= asset('assets/images/');
    return response()->json(['status' => true, 'data' => $data, 'error' => []]);
  }


  public function pricingPlan(){
    $data['pricing'] = Package::where('status', 1)->get();
    return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    
  }

  public function faqPage(){
    $data['faq'] = SiteContent::where('slug', 'faq')->first();
    return response()->json(['status' => true, 'data' => $data, 'error' => []]);
  }

  public function carDetails($slug){
    $car = Car::where('slug', $slug)->first();
    $data['car'] = CarResources::make($car);
    $data['image_url']= asset('assets/images/');
    $data['galleries'] = Gallery::where('car_id', $data['car']->id)->get();
    $data['vendor'] = User::where('id', $data['car']->user_id)->first();
    return response()->json(['status' => true, 'data' => $data, 'error' => []]);

  }


  public function vendorList(){
   
    $vendors = User::where('is_vendor', 1)->paginate(9);
    $data['vendors'] = VendorResource::collection($vendors)->response()->getData(true);
    return response()->json(['status' => true, 'data' => $data, 'error' => []]);
  }

  public function vendorProfile($slug){
    $vendor = User::where('username', $slug)->first();
    $data['vendor'] = VendorResource::make($vendor);
    $data['image_url']= asset('assets/images/');
    $cars = Car::where('user_id', $vendor->id)->paginate(6);
    $data['cars'] = CarResources::collection($cars)->response()->getData(true);
    return response()->json(['status' => true, 'data' => $data, 'error' => []]);

  }

  public function blogComment(Request $request,$slug){
    $blog = Blog::where('slug', $slug)->first();
    $validator = Validator::make(request()->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'message' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => false, 'data' => [], 'error' =>  $validator->errors()->first()]);
    }

    $comment = new BlogComment();
    $comment->blog_id = $blog->id;
    $comment->name = $request->name;
    $comment->email = $request->email;
    $comment->message = $request->message;
    $comment->save();
    return response()->json(['status' => true, 'data' => [], 'success' => 'Comment submitted successfully']);

  }

  public function blogAllComment($slug){
    $blog = Blog::where('slug', $slug)->first();
    $comments = BlogComment::where('blog_id', $blog->id)->get();
    return response()->json(['status' => true, 'data' => $comments, 'error' => []]);
  }

}
