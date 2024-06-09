<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'slug',
        'details',
        'header_title',
        'header_subtitle',
        'image',
        'video'
    ];
}
