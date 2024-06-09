<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(Currency::class)->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'plan_id')->withDefault();
    }
    
}
