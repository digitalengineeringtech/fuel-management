<?php

namespace App\Http\Resources\Local\Nozzles;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Local\Dispensers\DispenserResource;
use App\Http\Resources\Cloud\StockPrice\StockPriceResource;

class NozzleResource extends JsonResource
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
            'dispenser' => new DispenserResource($this->dispenser),
            'stockPrice' => new StockPriceResource($this->stockPrice),
            'nozzle_no' => $this->nozzle_no,
            'auto_approve' => $this->auto_approve,
            'semi_approve' => $this->semi_approve,
            'cashier_approve' => $this->cashier_approve
        ];
    }
}
