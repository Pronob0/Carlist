<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class WishlistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       $curr = Session::has('currency') ? Currency::findOrFail(Session::get('currency')) : Currency::whereDefault(1)->first();
      

        return [

            'id'   => $this->id,
            'slug' => $this->auction->slug,
            'product_name' => $this->auction->title,
            'product_price' => $this->auction->price*$curr->rate ,
            'highest_bid' =>  $this->auction->bids ? round($this->auction->bids->max('bid_amount'),2) : 'No Bid Yet',
            'time_left'  =>  Carbon::parse($this->auction->end_date)->diffForHumans(),
            'user_id' => $this->user_id,
            
            
        ];


        
        
    }
}


