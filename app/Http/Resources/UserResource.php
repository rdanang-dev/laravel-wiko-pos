<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image,
            'image_url' => $this->image ? Storage::disk('s3')->url($this->image) : 'https://via.placeholder.com/600',
            'roles' => $this->roles[0]->name,
            'role_id' => $this->roles[0]->id,
            'created_at' => Carbon::parse($this->created_at)->format('j F, Y'),
        ];
    }
}