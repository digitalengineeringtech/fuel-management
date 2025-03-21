<?php

namespace App\Http\Resources\Local\Sales;

use App\Http\Resources\Cloud\Customers\CustomerResource;
use App\Http\Resources\Cloud\Discounts\DiscountResource;
use App\Http\Resources\Cloud\FuelTypes\FuelTypeResource;
use App\Http\Resources\Cloud\Payments\PaymentResource;
use App\Http\Resources\Cloud\Stations\StationResource;
use App\Http\Resources\Cloud\VehicleTypes\VehicleTypeResource;
use App\Http\Resources\Local\Dispensers\DispenserResource;
use App\Http\Resources\Local\Nozzles\NozzleResource;
use App\Http\Resources\Local\Tanks\TankResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'dispenser' => new DispenserResource($this->dispenser),
            'nozzle' => new NozzleResource($this->nozzle),
            'fuelType' => new FuelTypeResource($this->fuelType),
            'payment' => new PaymentResource($this->payment),
            'discount' => new DiscountResource($this->discount),
            'customer' => new CustomerResource($this->customer),
            'vehicleType' => new VehicleTypeResource($this->vehicleType),
            'tank' => new TankResource($this->tank),
            'voucher_no' => $this->voucher_no,
            'cashier_code' => $this->cashier_code,
            'car_no' => $this->car_no,
            'device' => $this->device,
            'tank_balance' => $this->tank_balance,
            'totalizer_liter' => $this->totalizer_liter,
            'totalizer_amount' => $this->totalizer_amount,
            'device_totalizer_liter' => $this->device_totalizer_liter,
            'device_totalizer_amount' => $this->device_totalizer_amount,
            'sale_price' => $this->sale_price,
            'sale_liter' => $this->sale_liter,
            'total_price' => $this->total_price,
            'is_preset' => $this->is_preset,
            'preset_amount' => $this->preset_amount,
            'daily_report_date' => $this->daily_report_date,
        ];
    }
}
