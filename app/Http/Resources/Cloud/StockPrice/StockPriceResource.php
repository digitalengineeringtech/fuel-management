<?php

namespace App\Http\Resources\Cloud\StockPrice;

use App\Http\Resources\Cloud\FuelTypes\FuelTypeResource;
use App\Http\Resources\Cloud\Stations\StationResource;
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
            'unit_price' => $this->unit_price,
            'station' => new StationResource($this->station),
            'fuelType' => new FuelTypeResource($this->fuelType),
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
