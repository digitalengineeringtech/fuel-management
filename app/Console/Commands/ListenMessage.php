<?php

namespace App\Console\Commands;

use Hakhant\Broker\Client;
use Illuminate\Console\Command;

class ListenMessage extends Command
{
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

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client(config('mqtt.default'));

        $client->subscribe('detpos/#', function ($topic, $message) {
            $this->info('Topic: '.$topic);
            $this->info('Message: '.$message);

            // Do something with the message here ( Queue Job )
        });

        $this->info('Successfully subscribed to topic detpos/#');

        $client->loop();
    }
}
