<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;
  
    protected $appends = ['api_photo','api_created_at','api_description'];
    // created_at 
    

    protected $fillable = ['title','category_id','photo','slug', 'description', 'source', 'views','updated_at', 'status','meta_tag','meta_description','tags'];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class)->withDefault([
            'name' => 'Deleted',
        ]);
    }

    public function getApiPhotoAttribute()
    {
        $data = asset('assets/images/'. $this->photo) ;
        return $data;
    }

    public function getApiCreatedAtAttribute()
    {
        $data = date('d M Y', strtotime($this->created_at));
        return $data;
    }

    public function getApiDescriptionAttribute()
    {
        $data = strip_tags($this->description);
        $description = Str::limit($data, 200);
        return $description;
    }


}
