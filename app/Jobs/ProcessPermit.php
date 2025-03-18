<?php

namespace App\Jobs;

use App\Models\Nozzle;
use App\Traits\HasMqtt;
use App\Traits\HasSale;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class ProcessPermit
{
    use HasMqtt;
    use HasSale;
    use Queueable;

    public $user;

    public $messages;

    public $client;

    public function __construct(string $user, array $messages)
    {
        $this->user = $user;
        $this->messages = $messages;
        $this->client = $this->getClient();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $nozzle = Nozzle::where('nozzle_no', $this->messages[0])->first();
        $stationId = $nozzle->dispenser->station_id;
        $voucherNo = $this->generateVoucherNo($stationId, $nozzle->id, $this->user);

        if ($nozzle->auto_approve || $nozzle->semi_approve) {
            $sale = $this->createSale([
                'station_id' => $nozzle->dispenser->station_id,
                'dispenser_id' => $nozzle->dispenser_id,
                'nozzle_id' => $nozzle->id,
                'fuel_type_id' => $nozzle->stockPrice->fuel_type_id,
                'tank_id' => $nozzle->stockPrice->fuelType->tank->id,
                'voucher_no' => $voucherNo,
                'cashier_code' => Str::lower($this->user),
            ]);

            $this->client->publish('detpos/local_server/'.$sale->dispenser->dispenser_no, $sale->nozzle->nozzle_no.'appro');

            $this->client->disconnect();
        }
    }
}
