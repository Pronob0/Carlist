<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderSection extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'category_title',
        'category_subtitle',
        'featured_title',
        'featured_subtitle',
        'recentcars_title',
        'recentcars_subtitle',
        'blog_title',
        'blog_subtitle',
    ];
    
    // timetamps false 
    public $timestamps = false;
}
