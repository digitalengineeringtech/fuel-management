<?php

namespace App\Listeners;

use App\Events\MessageReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleMessage
{
    /**
     * Handle the event.
     */
    public function handle(MessageReceived $event): void
    {
         $topic = explode("/", $event->topic);

         match($topic[2]) {
            'preset' => info($event->message), // Handle ProcessPreset Job
            'permit' => info($event->message), // Handle ProcessPermit Job
            'livedata' => info($event->message), // Handle ProcessLiveData Job
            'Final' => info($event->message), // Handle ProcessFinal Job
            'pricechange' => info($event->message), // Handle ProcessPriceChange Job
         };
    }
}
