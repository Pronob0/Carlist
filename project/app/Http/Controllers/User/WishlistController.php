<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;
use App\Models\Auction;
use App\Models\Car;
use App\Models\Currency;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function wishlist_ids(){
        $data = Wishlist::where('user_id',auth()->user()->id)->select('product_id')->get();
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        
    }

    public function wishlist(){
        $wishlists = Wishlist::where('user_id',auth()->user()->id)->paginate(10);
        $data['wishlists'] = WishlistResource::collection($wishlists)->response()->getData(true);
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        
    }

    public function store($id){
        $wishlist = new Wishlist();
        $esist = Wishlist::where('user_id',auth()->user()->id)->where('product_id',$id)->first();

        if($esist){
           
            return response()->json(['status' => false, 'data' => [], 'error' => 'You already added this Car as wishlist']);
        }
        $car = Car::findOrFail($id);
        if($car->user_id == auth()->user()->id){
            
            return response()->json(['status' => false, 'data' => [], 'error' => 'You can not add your own product to wishlist']);
        }
        $wishlist->user_id = auth()->user()->id;
        $wishlist->product_id = $id;
        $wishlist->save();
        $data['message'] = 'Product added to wishlist';
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
       
    }

    public function details($id) {
       $curr = Session::has('currency') ? Currency::findOrFail(Session::get('currency')) : Currency::whereDefault(1)->first();
        $wishlist = Wishlist::findOrFail($id);
        $data['photo'] = getPhoto($wishlist->auction->photo);
        $data['title'] = $wishlist->auction->title;
        $data['slug'] = $wishlist->auction->slug;
        $data['auction_owner'] = $wishlist->auction->user->name;
        $data['price'] = $wishlist->auction->price * $curr->rate . ' ' . $curr->code;

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);

    }

    public function remove($id) {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        $data['message'] = 'Product removed from wishlist';
        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }
}
