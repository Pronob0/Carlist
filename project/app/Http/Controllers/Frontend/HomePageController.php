<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResources;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Fuel;
use App\Models\Generalsetting;
use App\Models\HeaderSection;
use App\Models\Modal;
use App\Models\Page;
use App\Models\SiteContent;
use App\Models\Subscriber;
use App\Models\Transmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomePageController extends Controller
{
    public function heroSection()
    {
        $data['hero_contents'] = SiteContent::where('slug', 'hero')->select('content','status')->first();
        $oldcontent = $data['hero_contents']->content;
        $oldcontent= json_decode(json_encode($oldcontent,true),true);
        $oldcontent['background'] = asset("assets/images/".$oldcontent['background']);
        $oldcontent['image'] = asset("assets/images/".$oldcontent['image']);
        $data['hero_contents']->content = $oldcontent;
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);

    }
    public function homeSection()
    {
        // api response will be here
        $hero_contents = SiteContent::where('slug', 'hero')->select('content','status')->first();
        $oldcontent = $hero_contents->content;
        $oldcontent= json_decode(json_encode($oldcontent,true),true);
        $oldcontent['background'] = asset("assets/images/".$oldcontent['background']);
        $oldcontent['image'] = asset("assets/images/".$oldcontent['image']);
        $hero_contents->content = $oldcontent;
        $data['hero_section'] = $hero_contents;

        // filter section 
        $categories = Category::where('status', 1)->select('id','name','slug')->get();
        $brands = Brand::where('status', 1)->select('id','name','slug')->get();
        $conditions = Condition::where('status', 1)->select('id','name','slug')->get();
        $models = Modal::where('status', 1)->select('id','name','slug')->get();
        $transmissions = Transmission::where('status', 1)->select('id','name','slug')->get();
        $fuels = Fuel::where('status', 1)->select('id','name','slug')->get();
        $data['filter_section'] = ['categories' => $categories, 'brands' => $brands, 'conditions' => $conditions, 'models' => $models, 'transmissions' => $transmissions, 'fuels' => $fuels];
        // filter section end

        // category section 
        $category_contents = SiteContent::where('slug', 'categories')->select('content','status')->first();
        $all_brand_categories = Brand::where('status', 1)
        ->withCount('cars')->take(8)
        ->get()
        ->map(function($brand){
            $brand->image = asset('assets/images/'.$brand->image);
            return $brand;
        });
        $data['category_section'] = ['content' => $category_contents, 'all_brand_categories' => $all_brand_categories];
        // category Section end 
        // Feature section here 
        $feature_header= HeaderSection::select('featured_title', 'featured_subtitle')->findOrfail(1);
        $featured_carsx = Car::where('status', 1)->where('is_feature', 1)->get();
        $featured_cars = CarResources::collection($featured_carsx); 
        $data['feature_section'] = ['feature_header' => $feature_header, 'featured_cars' => $featured_cars];


        $vendors = SiteContent::where('slug', 'vendor')->first();
        $vendorcontent = $vendors->content;
        $vendorcontent= json_decode(json_encode($vendorcontent,true),true);
        $vendorcontent['image'] = asset("assets/images/".$vendorcontent['image']);
        // add status 
        $vendors->content = $vendorcontent;
        $vendors->status = $vendors->status;

        $data['vendor_section'] = ['content' => $vendors->content, 'status' => $vendors->status];

        // recent cars section here 
        $recent_header= HeaderSection::select('recentcars_title', 'recentcars_subtitle')->findOrfail(1);
        $type = request()->type == 'sell' ? 1 : 0;
        if($type){
            $recentcars = Car::where('status', 1)->where('type', $type)->orderBy('id', 'desc')->take(8)->get();

        }
        else{
            $recentcars = Car::where('status', 1)->orderBy('id', 'desc')->take(8)->get();
        }
        
        $recent_cars = CarResources::collection($recentcars);
        $data['recent_cars'] = ['recent_header' => $recent_header, 'recent_cars' => $recent_cars];
        // blogs section here
        $blog_header= HeaderSection::select('blog_title', 'blog_subtitle')->findOrfail(1);
        $blogs = Blog::where('status', 1)->orderBy('id', 'desc')->take(3)->get();
        $data['blog_section'] = ['blog_header' => $blog_header, 'blogs' => $blogs];

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        
    }

    public function social(){
        $data['social'] = SiteContent::where('slug', 'social')->select('sub_content')->first();
        $data['social']->sub_content = json_decode(json_encode($data['social']->sub_content,true),true);
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);

    }

    public function categorySection()
    {
        $data['category_contents'] = SiteContent::where('slug', 'categories')->select('content','status')->first();
        $data['all_brand_categories'] = Brand::where('status', 1)
        ->withCount('cars')->take(8)
        ->get()
        ->map(function($brand){
            $brand->image = asset('assets/images/'.$brand->image);
            return $brand;
        });
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function aboutSection()
    {
        // api response will be here
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

        return response()->json(['status' => true, 'data' => $about, 'error' => []]);
    }

    public function featuredCars()
    {
        // api response will be here
        $data['feature_header']= HeaderSection::select('featured_title', 'featured_subtitle')->findOrfail(1);
        $featured_cars = Car::where('status', 1)->where('is_feature', 1)->get();
        $data['featured_cars'] = CarResources::collection($featured_cars); 
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function vendor(){
        $data['vendors'] = SiteContent::where('slug', 'vendor')->first();
        $oldcontent = $data['vendors']->content;
        $oldcontent= json_decode(json_encode($oldcontent,true),true);
        $oldcontent['image'] = asset("assets/images/".$oldcontent['image']);
        $data['vendors']->content = $oldcontent;
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function recentCars(){
        $data['header_section']= HeaderSection::select('recentcars_title', 'recentcars_subtitle')->findOrfail(1);
        $type = request()->type == 'sell' ? 1 : 0;
        if($type){
            $recentcars = Car::where('status', 1)->where('type', $type)->orderBy('id', 'desc')->take(8)->get();

        }
        else{
            $recentcars = Car::where('status', 1)->orderBy('id', 'desc')->take(8)->get();
        }
        
        $data['recent_cars'] = CarResources::collection($recentcars);
        
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function testimonial(){
        $testimonial = SiteContent::where('slug', 'testimonial')->first();
        $data['content'] = $testimonial->content;
        $subcontent = $testimonial->sub_content;
        $subcontent = json_decode(json_encode($subcontent,true),true);
        foreach($subcontent as $key => $value){
            $subcontent[$key]['image'] = asset("assets/images/".$value['image']);
        }
        $testimonial->sub_content = $subcontent;
        $data['sub_content'] = $testimonial->sub_content;
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function partner(){
        $partners = SiteContent::where('slug', 'partner')->first();
        $data['content'] = $partners->content;
        $subcontent = $partners->sub_content;
        $subcontent = json_decode(json_encode($subcontent,true),true);
        foreach($subcontent as $key => $value){
            $subcontent[$key]['image'] = asset("assets/images/".$value['image']);
        }
        $partners->sub_content = $subcontent;
        $data['sub_content'] = $partners->sub_content;
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function footer(){
        $data['footer'] = Generalsetting::select('footer_text','header_logo')->first();
        $data['footer']->header_logo = asset('assets/images/'.$data['footer']->header_logo);
        $contact_info = SiteContent::where('slug', 'contact')->select('content')->first();
        $data['phone'] = json_decode($contact_info->content->phone) ;
        $data['email'] = json_decode($contact_info->content->email) ;
        $data['address'] = $contact_info->content->address;
        $data['pages'] = Page::get();
        
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);

    }

    public function subscriber(Request $request ){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        return response()->json(['status' => true, 'data' => [], 'success'=>'Subscribe Sucessfully!', 'error' => []]);

    }

    public function blogSection(){
        $data['header_section']= HeaderSection::select('blog_title', 'blog_subtitle')->findOrfail(1);
        $data['blogs'] = Blog::where('status', 1)->orderBy('id', 'desc')->take(3)->get();
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function generalSetting(){
        // expect menu 
        
        $data['settings'] = Generalsetting::first();
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function frontMenus(){
        $gs = Generalsetting::first();
        $data['menus'] = json_decode($gs->menu);
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        
    }

    public function page($slug){
        $data = Page::where('slug', $slug)->first();
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }


}
