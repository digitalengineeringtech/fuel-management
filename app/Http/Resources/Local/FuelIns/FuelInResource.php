<?php

namespace App\Http\Resources\Local\FuelIns;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Cloud\FuelTypes\FuelTypeResource;
use App\Http\Resources\Cloud\Stations\StationResource;
use App\Http\Resources\Local\Tanks\TankResource;

class FuelInResource extends JsonResource
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
            'tank' => new TankResource($this->tank),
            'station' => new StationResource($this->station),
            'fuelType' => new FuelTypeResource($this->fuelType),
            'code' => $this->code,
            'terminal_name' => $this->tank_no,
            'driver_name' => $this->tank_no,
            'bowser_no' => $this->tank_no,
            'tank_capacity' => $this->tank_no,
            'opening_balance' => $this->tank_no,
            'current_balance' => $this->tank_no,
            'send_balance' => $this->tank_no,
            'receive_balance' => $this->tank_no,
            'receive_date' => $this->tank_no,
        ];
    }
}
