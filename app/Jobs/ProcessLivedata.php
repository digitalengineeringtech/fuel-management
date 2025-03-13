<?php

namespace App\Jobs;

use Illuminate\Foundation\Queue\Queueable;

class ProcessLivedata
{
    use Queueable;

    public $topics;

    public $messages;
    public function __construct($topics, $messages)
    {
        $this->topics = $topics;
        $this->messages = $messages;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // TODO
    }
}
