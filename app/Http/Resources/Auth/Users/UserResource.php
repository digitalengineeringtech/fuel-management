<?php

namespace App\Http\Resources\Auth\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'station_id' => $this->station_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'card_id' => $this->card_id,
            'tank_count' => $this->tank_count
        ];
    }
}
