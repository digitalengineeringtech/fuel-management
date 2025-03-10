<?php

namespace App\Console\Commands;

use App\Events\MessageReceived;
use App\Traits\HasMqtt;
use Hakhant\Broker\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Concurrency;

class SubscribeMessage extends Command
{
    use HasMqtt;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe for mqtt topic';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = $this->getClient();

        $client->subscribe('detpos/device/#', function ($topic, $message) {
            $this->info('Topic: '.$topic);
            $this->info('Message: '.$message);

            $topics = $this->splitTopic($topic);

            Concurrency::run(function () use ($topic, $message) {
                event(new MessageReceived($topic, $message));
            });
        });

        $this->info('Successfully connected to MQTT broker and listening for messages...');

        $client->loop();
    }
}
