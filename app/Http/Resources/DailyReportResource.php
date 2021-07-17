<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyReportResource extends JsonResource
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
            'total_price' => $this->total_price,
            'order_code' => $this->order_code,
            'date' => Carbon::today()->format('j F, Y'),
            'employee' => $this->employee,
        ];
    }
}