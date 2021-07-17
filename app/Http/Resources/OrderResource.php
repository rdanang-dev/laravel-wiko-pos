<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'employee_id' => $this->employee_id,
            'order_code' => $this->order_code,
            'order_number' => $this->order_number,
            'notes' => $this->notes,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'details' => OrderDetailResource::collection($this->details),
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y (H:i)'),
            'employee_name' => $this->employee->name,
            'trans_date' => Carbon::parse($this->created_at)->format('j F, Y'),
        ];
    }
}