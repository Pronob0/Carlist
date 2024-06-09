<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'photo',
        'phone',
        'country',
        'city',
        'email_verified',
        'verification_link',
        'address',
        'status',
        'zip',
        'password',
        'is_plan',
        'social_link'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'kyc_info' => 'array'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }


    protected static function boot(){
        parent::boot();
        static::created(function($user){
            LoginLogs::create([
                'user_id' => auth()->id(),
                'ip' => @loginIp()->geoplugin_request,
                'country' => @loginIp()->geoplugin_countryName,
                'city' => @loginIp()->geoplugin_city,
            ]);
        });
    }
    
    public function dailyLimit()
    {
        $rate = defaultCurr()->rate;
        return  $this->transactions()->where('remark','transfer_money')->whereDate('created_at',Carbon::now())->selectRaw("SUM(amount / $rate) as total")->get()->sum('total');
    }

    public function monthlyLimit()
    {
        $rate = defaultCurr()->rate;
        return  $this->transactions()->where('remark','transfer_money')->whereMonth('created_at',Carbon::now()->month)->selectRaw("SUM(amount / $rate) as total")->get()->sum('total');
    }

    public function cashOutDailyLimit()
    {
        $rate = defaultCurr()->rate;
        return  $this->transactions()->where('remark','cash_out')->whereDate('created_at',Carbon::now())->selectRaw("SUM(amount / $rate) as total")->get()->sum('total');
    }

    public function cashOutMonthlyLimit()
    {
        $rate = defaultCurr()->rate;
        return  $this->transactions()->where('remark','cash_out')->whereMonth('created_at',Carbon::now()->month)->selectRaw("SUM(amount / $rate) as total")->get()->sum('total');
    }

    public function tickets()
    {
        return $this->hasMany(SupportTicket::class);
    }


    function wistlists() {
        return $this->hasMany(Wishlist::class);
        
    }

    public function withdraws()
    {
        return $this->hasMany(Withdrawals::class);
    }



 

   
}
