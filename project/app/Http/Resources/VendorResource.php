<?php

namespace App\Http\Resources;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $count = Car::where('user_id', $this->id)->count();
         
        return[
            'name' => $this->name,
            'total_car' => $count,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'image' => $this->photo,
            'image_url' => asset('assets/images/'),
        ];
        
    }
}
