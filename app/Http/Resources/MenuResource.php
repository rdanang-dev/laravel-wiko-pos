<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MenuResource extends JsonResource
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
            'nama' => $this->nama,
            'slug' => $this->slug,
            'harga' => $this->harga,
            'image' => $this->image,
            'image_url' => $this->image ? Storage::disk('s3')->url($this->image) : 'https://via.placeholder.com/600',
        ];
    }
}
