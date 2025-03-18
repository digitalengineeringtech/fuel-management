<?php

namespace App\Jobs;

use App\Models\Nozzle;
use App\Traits\HasMqtt;
use Illuminate\Foundation\Queue\Queueable;

class ProcessPriceChange
{
    use HasMqtt;
    use Queueable;

    public $messages;

    public $client;

    public function __construct(array $messages)
    {
        $this->messages = $messages;
        $this->client = $this->getClient();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $nozzle = Nozzle::where('nozzle_no', $this->messages[0])->first();

        $unit_price = str_pad($this->messages[1], 4, '0', STR_PAD_LEFT);

        $nozzle->stockPrice()->update([
            'unit_price' => $unit_price,
        ]);

        $this->client->publish('detpos/local_server/price', $nozzle->nozzle_no.$unit_price);

        $this->client->disconnect();
    }
}
