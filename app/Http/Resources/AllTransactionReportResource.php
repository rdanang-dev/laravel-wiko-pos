<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AllTransactionReportResource extends JsonResource
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
            'order_total' => $this->order_total,
            'employee_id' => $this->employee_id,
            'order_code' => $this->order_code,
            'order_date' => Carbon::parse($this->created_at)->format('j F, y'),
            'employee' => $this->employee,
            'details' => $this->details
        ];
    }
}