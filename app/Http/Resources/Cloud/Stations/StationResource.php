<?php

namespace App\Http\Resources\Cloud\Stations;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Cloud\Shops\ShopResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StationResource extends JsonResource
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
            'shop_id' => new ShopResource($this->shop),
            'name' => $this->name,
            'station_no' => $this->station_no,
            'image' => asset($this->image),
            'phone_one' => $this->phone_one,
            'phone_two' => $this->phone_two,
            'address' => $this->address,
            'opening_date' => $this->opening_date,
            'expiry_date' => $this->expiry_date,
            'opening_hour' => $this->opening_hour,
            'closing_hour' => $this->closing_hour,
            'subscribe_year' => $this->subscribe_year,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
