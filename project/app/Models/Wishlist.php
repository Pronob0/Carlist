<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Wishlist extends Model
{
    use HasFactory;

    public function auction(){
        return $this->belongsTo(Auction::class,'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
