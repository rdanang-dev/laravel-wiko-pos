<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardRecentTransactionResource extends JsonResource
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
            'order_date' => Carbon::parse($this->created_at)->diffForHumans(),
            'employee' => $this->employee
        ];
    }
}