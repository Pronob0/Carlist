<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       $curr = Session::has('currency') ? Currency::findOrFail(Session::get('currency')) : Currency::whereDefault(1)->first();

        return [
            'package' => $this->package ? $this->package->title : 'N/A',
            'trx' => $this->trnx,
            'amount' => round($this->amount,2),
            'status' => $this->status ,
            'method' =>$this->gateway,
            'date' => Carbon::parse($this->created_at)->format('d M Y'),
            'type' => $this->type,

        ];


        
        
    }
}


