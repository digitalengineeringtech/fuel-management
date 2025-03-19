<?php

namespace App\Http\Resources\Local\FuelIns;

use App\Http\Resources\Cloud\FuelTypes\FuelTypeResource;
use App\Http\Resources\Cloud\Stations\StationResource;
use App\Http\Resources\Local\Tanks\TankResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'terminal_name' => $this->terminal_name,
            'driver_name' => $this->driver_name,
            'bowser_no' => $this->bowser_no,
            'tank_capacity' => $this->tank_capacity,
            'opening_balance' => $this->opening_balance,
            'current_balance' => $this->current_balance,
            'send_balance' => $this->send_balance,
            'receive_balance' => $this->receive_balance,
            'receive_date' => $this->receive_date,
        ];
    }
}
