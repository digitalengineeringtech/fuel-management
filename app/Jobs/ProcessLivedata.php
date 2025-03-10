<?php

namespace App\Jobs;

use App\Traits\HasMqtt;
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Queue\Queueable;

class ProcessLivedata
{
    use HasMqtt;
    use Queueable;

    public $topics;

    public $messages;

    public $client;
    public function __construct($topics, $messages)
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

        $sale = json_decode($redis, true);

        // TODO: Handle the message
    }
}
