<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'order_id' => $this->order_id,
            'name' => $this->menu->name ?? '',
            'menu_id' => $this->menu_id,
            'price' => $this->price,
            'discount' => $this->discount,
            'qty' => $this->qty,
            'total_price' => $this->price * $this->qty,
        ];
    }
}
