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

    public array $attributes;

    public $client;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        $this->client = $this->getClient();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $nozzle = Nozzle::where('id', $this->attributes['nozzle_id'])->first();
        $cashier = 'C1';
        $stationNo = $nozzle->dispenser->station->station_no;
        $voucherNo = $this->generateVoucherNo($stationNo, $nozzle->id, $cashier);

        $sale = $this->createSale([
            ...$this->attributes,
            'voucher_no' => $voucherNo,
            'cashier_code' => $cashier,
            'is_preset' => true,
            'preset_amount' => $this->getPresetAmount($this->attributes['type'], $this->attributes['preset_amount']),
        ]);

        $this->client->publish('detpos/local_server/preset', $nozzle->nozzle_no . $this->attributes['type'] . $this->attributes['preset_amount']);
    }
}
