<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardYearlyReportResource extends JsonResource
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
            'first_trans' => Carbon::parse($this->first_trans)->format('j F, Y'),
            'last_trans' => Carbon::parse($this->last_trans)->format('j F, Y'),
            'tahun' => $this->tahun,
        ];
    }
}