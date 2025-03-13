<?php

namespace App\Http\Resources\Cloud\FuelTypes;

use App\Http\Resources\Local\Tanks\TankResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuelTypeResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
