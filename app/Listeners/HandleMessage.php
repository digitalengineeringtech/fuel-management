<?php

namespace App\Listeners;

use App\Events\MessageReceived;
use App\Jobs\ProcessFinal;
use App\Jobs\ProcessPermit;
use App\Jobs\ProcessPreset;
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
            'preset' => ProcessPreset::dispatch($topics, $messages),
            'permit' => ProcessPermit::dispatch($topics, $messages),
            'Final' => ProcessFinal::dispatch($topics, $messages),
            'pricechange' => ProcessPriceChange::dispatch($topics, $messages),
        };
    }
}
