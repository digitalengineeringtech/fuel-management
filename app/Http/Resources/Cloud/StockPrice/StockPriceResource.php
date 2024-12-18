<?php

namespace App\Http\Resources\Cloud\StockPrice;

use App\Models\FuelType;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockPriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'station' => Station::find($this->station_id),
            'fuel_type' => FuelType::find($this->fuel_type_id),
            'nozzle_no' => $this->nozzle_no,
            'unit_price' => $this->unit_price,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
