<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'title','slug', 'price', 'term', 'number_of_car_add', 'number_of_car_featured', 'status'];
    public $timestamps = false;


}

