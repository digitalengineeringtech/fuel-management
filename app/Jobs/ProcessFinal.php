<?php

namespace App\Jobs;

use App\Models\Sale;
use App\Models\Nozzle;
use App\Traits\HasMqtt;
use App\Traits\HasSale;
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Queue\Queueable;

class ProcessFinal
{
    use Queueable;

    use HasMqtt;

    use HasSale;

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
         $redis = Redis::get('sale');

         $cachedSale = json_decode($redis, true);

         $nozzle = Nozzle::where('id', $cachedSale['id'])->first();
         // TODO: Handle the message
         $updatedSale = $this->updateSale($cachedSale, $this->messages);

         $this->client->publish('detpos/local_server/'.$nozzle->dispenser_id, $nozzle->nozzle_no.'D1S1');

         $this->client->disconnect();
    }
}
