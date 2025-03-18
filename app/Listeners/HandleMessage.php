<?php

namespace App\Listeners;

use App\Events\MessageReceived;
use App\Jobs\ProcessFinal;
use App\Jobs\ProcessLivedata;
use App\Jobs\ProcessPermit;
use App\Jobs\ProcessPriceChange;
use App\Traits\HasMqtt;

class HandleMessage
{
    use HasMqtt;

    /**
     * Handle the event.
     */
    public function handle(MessageReceived $event): void
    {
        $topics = $this->splitTopic($event->topic);
        $messages = $this->splitMessage($event->message);

        match ($topics[2]) {
            'permit' => ProcessPermit::dispatch($event->user, $messages), // only for auto approve and semi approve
            'livedata' => ProcessLivedata::dispatch($event->user, $messages),
            'Final' => ProcessFinal::dispatch($event->user, $messages),
            'pricereq' => ProcessPriceChange::dispatch($messages),
            default => null
        };
    }
}
