<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class DepositResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'deposit_number'=> $this->deposit_number,
            'deposit_date'  => Carbon::parse($this->created_at)->format('d M Y'),
            'method'        => $this->method,
            'user_email'    => $this->user->email,
            'amount'        => $this->amount,
            'status'        => $this->status == 'pending' ? 'Pending' : "Completed",
        ];
    }
}
