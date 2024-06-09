<?php

namespace App\Models;

use Illuminate\{
    Database\Eloquent\Model
};


class PaymentGateway extends Model
{
    protected $fillable = ['title', 'details', 'subtitle', 'name', 'type', 'information', 'currency_id', 'status', 'fixed_charge', 'percent_charge'];
    public $timestamps = false;
    protected $casts = ['currency_id' => 'array'];

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency')->withDefault();
    }

    public static function scopeHasGateway($curr)
    {
        return PaymentGateway::where('currency_id', 'like', "%\"{$curr}\"%")->get();
    }

    public function convertAutoData()
    {
        return  json_decode($this->information, true);
    }

    public function getAutoDataText()
    {
        $text = $this->convertAutoData();
        return end($text);
    }

    public function showKeyword()
    {
        $data = $this->keyword == null ? 'other' : $this->keyword;
        return $data;
    }

   

    

    public function showDepositLink($amount, $user, $id)
    {
        $link = '';
        $data = $this->keyword;
        if ($data == 'paypal') {
            $link = route('deposit.paypal.submit', [$amount, $user, $id]);
        } else if ($data == 'stripe') {
            $link = route('deposit.stripe.submit', [$amount, $user, $id]);
        } else if ($data == 'razorpay') {
            $link = route('deposit.razorpay.submit', [$amount, $user, $id]);
        }  else if ($data == 'mercadopago') {
            $link = route('deposit.mercadopago.submit', [$amount, $user, $id]);
        }   else if ($data == null) {
            $link = route('deposit.manual.submit', [$amount, $user, $id]);
        }
        return $link;
    }
   


    public function showForm()
    {
        $show = '';
        $data = $this->keyword == null ? 'other' : $this->keyword;
        $values = ['cod', 'voguepay', 'sslcommerz', 'flutterwave', 'razorpay', 'mollie', 'paytm', 'paystack', 'paypal', 'instamojo' . 'stripe'];
        if (in_array($data, $values)) {
            $show = 'no';
        } else {
            $show = 'yes';
        }
        return $show;
    }
}
