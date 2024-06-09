<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorCarResources extends JsonResource
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
            'mileage'       => $this->mileage,
            'brand'         => $this->brand->name,
            'model'         => $this->model->name,
            'is_feature'   => $this->is_feature,
            'status'        => $this->status,
            


        ];
    }
}
