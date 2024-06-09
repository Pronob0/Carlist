<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'title',
        'slug',
        'category_id',
        'image',
        'current_price',
        'previous_price',
        'mileage',
        'is_feature',
        'status',
        'condition_id', 
        'brand_id',
        'model_id',
        'fuel_id',
        'transmission_id',
        'description',
        'specification',
        'video_image1',
        'video_image2',
        'video_link1',
        'video_link2',
        'tags',
        'meta_tag',
        'meta_description',
        'user_id',
        'type'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function model()
    {
        return $this->belongsTo(Modal::class);
    }


    public function transmission()
    {
        return $this->belongsTo(Transmission::class);
    }


    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'car_id');
    }

    
}
