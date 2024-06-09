<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modal extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'brand_id', 'slug', 'status'];


    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
