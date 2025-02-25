<?php

namespace App\Http\Resources\Local\Customers;

use App\Http\Resources\Cloud\VehicleTypes\VehicleTypeResource;
use App\Http\Resources\Local\Members\MemberResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->name,
            'car_number' => $this->car_number,
            'type' => $this->type,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'card_number' => $this->card_number,
            'debit_liter' => $this->debit_liter,
            'debit_amount' => $this->debit_amount,
            'vehicle_type_id' => new VehicleTypeResource($this->vehicleType),
            'member' => new MemberResource($this->member),
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
