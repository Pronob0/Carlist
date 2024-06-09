<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        
        $user = $this->user_id == 0 ? 'Admin' : $this->user->name;


        return [
            'id'            => $this->id,
            'user_name'     => $user,
            'title'        => $this->title,
            'slug'          => $this->slug,
            'current_price' => $this->current_price,
            'previous_price' => $this->previous_price,
            'mileage'       => $this->mileage,
            'year'          => date('Y', strtotime($this->created_at)),
            'fuel'         => $this->fuel->name,
            'condition'     => $this->condition->name,
            'brand'         => $this->brand->name,
            'model'         => $this->model->name,
            'for'           => $this->type == 1 ? 'Sell' : 'Rent',
            'transmission'  => $this->transmission->name,
            'category'      => $this->category->name,
            'image'         => asset('assets/images/'.$this->image),
            'specification' => json_decode($this->specification),
            'video_image1'  =>  asset('assets/images/'.$this->video_image1), // asset('assets/images/'.$this->video_image1
            'video_image2'  => asset('assets/images/'.$this->video_image2), // asset('assets/images/'.$this->video_image2
            'video_link1'   => $this->video_link1,
            'video_link2'   => $this->video_link2,
            'description'   => $this->description,
            'tags'          => explode(',', $this->tags),
            'is_feature'   => $this->is_feature,
            'status'        => $this->status,
            


        ];
    }
}
