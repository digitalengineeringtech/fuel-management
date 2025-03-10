<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Queue\Queueable;

class ProcessFinal
{
    use Queueable;

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
         $redis = Redis::get('sale');

         $sale = json_decode($redis, true);

         // TODO: Handle the message

         Redis::del('sale');
    }
}
