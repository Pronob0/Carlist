<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTable extends Model
{
    use HasFactory;
    // appends 

    protected $appends = ['api_photo'];
    public $timestamps = false;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
    ];

    public function getApiPhotoAttribute()
    {
        $data = asset('assets/images/'. $this->image) ;
        return $data;
    }
}
