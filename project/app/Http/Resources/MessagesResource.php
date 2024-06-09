<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Admin;

class MessagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        $admin_photo = $this->admin_id == null ? 'null' : getPhoto(Admin::findOrFail($this->admin_id)->photo);
        $user = auth()->user();
        return [
            'id'            => $this->id,
            'ticket_id'     => $this->ticket_id,
            'ticket_num'    => $this->ticket_num,
            'user_name'     => $user->name,
            'user_photo'    => getPhoto($user->photo),
            'user_id'       => $user->id,
            'admin_id'      => $this->admin_id,
            'message'       => $this->message,
            'file'          => getPhoto($this->file),
            'title'         => Carbon:: parse($this->created_at)->format('l jS \of F Y h:i:s A'),
            'admin_id'      => $this->admin_id,
            'admin_photo' => $admin_photo,
            'admin_name' => $this->admin_id == null ? 'null' : Admin::findOrFail($this->admin_id)->name


        ];
    }
}
