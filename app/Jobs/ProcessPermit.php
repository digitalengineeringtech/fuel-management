<?php

namespace App\Jobs;

use App\Models\Sale;
use App\Models\Nozzle;
use App\Traits\HasMqtt;
use App\Traits\HasSale;
use Illuminate\Foundation\Queue\Queueable;

class ProcessPermit
{
    use HasSale;

    use HasMqtt;

    use Queueable;

    public $topics;

    public $messages;

    public $client;

    public function __construct(array $topics, array $messages)
    {
        $this->topics = $topics;
        $this->messages = $messages;
        $this->client = $this->getClient();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $nozzle = Nozzle::where('nozzle_no', $this->messages[0])->first();
        $cashier = 'C1';
        $stationId = $nozzle->dispenser->station_id;
        $voucherNo = $this->generateVoucherNo($stationId, $nozzle->id, $cashier);

        if($nozzle->auto_approve || $nozzle->semi_approve) {
            $sale = $this->createSale([
                'station_id' => $nozzle->dispenser->station_id,
                'dispenser_id' => $nozzle->dispenser_id,
                'nozzle_id' => $nozzle->id,
                'fuel_type_id' => $nozzle->stockPrice->fuel_type_id,
                'tank_id' => $nozzle->stockPrice->fuelType->tank->id,
                'voucher_no' => $voucherNo,
                'cashier_code' => $cashier,
            ]);

            $this->client->publish("detpos/local_server/".$sale->dispenser->dispenser_no, $sale->nozzle->nozzle_no."appro");

            $this->client->disconnect();
        }
    }
}
