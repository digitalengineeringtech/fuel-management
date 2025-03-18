<?php

namespace App\Jobs;

use App\Models\Nozzle;
use App\Traits\HasMqtt;
use App\Traits\HasSale;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Redis;

class ProcessFinal
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
        $redis = Redis::get('sale');

        $cachedSale = json_decode($redis, true);

        $nozzle = Nozzle::where('id', $cachedSale['id'])->first();
        // TODO: Handle the message
        $updatedSale = $this->updateSale($cachedSale, $this->messages);

        $this->client->publish('detpos/local_server/'.$nozzle->dispenser->dispenser_no, $nozzle->nozzle_no.'D1S1');

        $this->client->disconnect();
    }
}
