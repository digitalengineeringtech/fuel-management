<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Traits\HasMqtt;
use App\Events\MessageReceived;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

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
        try {
            $client = $this->getClient();

            $client->subscribe('detpos/#', function ($topic, $message) {
                $redis = Redis::get('user');

                $user = User::where('id', $redis)->first();

                if ($user == null) {
                    $this->error('Please login first...');

                    return;
                }

                $this->info('Topic: '.$topic);
                $this->info('Message: '.$message);

                event(new MessageReceived($user, $topic, $message));
            });

            $this->info('Successfully connected to MQTT broker and listening for messages...');

            $client->loop();

        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
