<?php

namespace App\Console\Commands;

use App\Traits\HasMqtt;
use Hakhant\Broker\Client;
use Illuminate\Console\Command;

class ListenMessage extends Command
{
    use HasMqtt;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listen:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for mqtt topic';

    protected $retry = 3;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqttOne = config('mqtt.default');
        $mqttTwo = config('mqtt.mqtt-two');

        $configs = $this->handleConnectionWithRetry($mqttOne, $this->retry);

        // If connection fails after retries, fallback to the second broker (mqttTwo)
        if (! $configs) {
            $this->warn('Failed to connect to the first MQTT broker after 3 retries...');

            $this->info('Trying to connect to the second MQTT broker...');

            $configs = $this->handleConnectionWithRetry($mqttTwo, $this->retry);

            if (! $configs) {
                $this->warn('Failed to connect to both MQTT brokers. Please check your mqtt connections...');

                return;
            }
        }

        $client = new Client($configs);

        $this->info("Connected to MQTT broker at {$configs['host']}:{$configs['port']}");

        $client->subscribe('detpos/#', function ($topic, $message) {
            $this->info('Topic: '.$topic);
            $this->info('Message: '.$message);

            // Do something with the message here ( Queue Job )
        });

        $this->info('Successfully connected to MQTT broker and listening for messages...');

        $client->loop();
    }
}
