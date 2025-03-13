<?php

namespace App\Jobs;

use App\Models\Nozzle;
use App\Traits\HasMqtt;
use App\Traits\HasSale;
use Illuminate\Foundation\Queue\Queueable;

class ProcessPreset
{
    use Queueable;

    use HasMqtt;

    use HasSale;

    public $topics;

    public $messages;

    public function __construct(array $topics, array $messages)
    {
        $this->topics = $topics;
        $this->messages = $messages;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $nozzle = Nozzle::where('nozzle_no', $this->messages[0])->first();
        $cashier = 'C1';
        $stationNo = $nozzle->dispenser->station->station_no;
        $voucherNo = $this->generateVoucherNo($stationNo, $nozzle->id, $cashier);

        $sale = $this->createSale([
            'station_id' => $nozzle->dispenser->station_id,
            'dispenser_id' => $nozzle->dispenser_id,
            'nozzle_id' => $nozzle->id,
            'fuel_type_id' => $nozzle->stockPrice->fuel_type_id,
            'tank_id' => $nozzle->stockPrice->fuelType->tank->id,
            'voucher_no' => $voucherNo,
            'cashier_code' => $cashier,
            'is_preset' => true,
            'preset_amount' => $this->messages[1],
        ]);
    }
}
