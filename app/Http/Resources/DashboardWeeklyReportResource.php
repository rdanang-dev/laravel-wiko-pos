<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardWeeklyReportResource extends JsonResource
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
            'total_transaction' => $this->total_transaction,
            'order_date' => Carbon::parse($this->order_date)->format('d-m-Y'),
        ];
    }
}