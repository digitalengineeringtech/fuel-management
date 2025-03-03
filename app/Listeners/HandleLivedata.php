<?php

namespace App\Listeners;

use App\Events\LivedataReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleLivedata
{
    public function handle(LivedataReceived $event): void
    {
        //
    }
}
