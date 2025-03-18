<?php

namespace App\Jobs;

use Illuminate\Foundation\Queue\Queueable;

class ProcessLivedata
{
    use Queueable;

    public $user;

    public $messages;

    public function __construct(string $user, array $messages)
    {
        $this->user = $user;
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
