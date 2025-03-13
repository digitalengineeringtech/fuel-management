<?php

namespace App\Http\Resources\Local\Tanks;

use App\Http\Resources\Cloud\Stations\StationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TankResource extends JsonResource
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
            'station' => new StationResource($this->station),
            'oil_type' => $this->oil_type,
            'state_info' => $this->state_info,
            'volume' => $this->volume,
            'oil_ratio' => $this->oil_ratio,
            'level' => $this->level,
            'temperature' => $this->temperature,
            'weight' => $this->weight,
            'water_ratio' => $this->water_ratio,
            'avaliable_oil_weight' => $this->avaliable_oil_weight
        ];
    }
}
