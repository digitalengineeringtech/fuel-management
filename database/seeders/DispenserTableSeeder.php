<?php

namespace Database\Seeders;

use App\Models\Dispenser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DispenserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dispensers = [
            [
                'station_id' => 1,
                'device_ip' => '192.168.0.101',
                'server_ip' => '192.168.0.100',
                'server_port' => 9000,
                'dispenser_no' => '1',
                'firmware_version' => 'v'.rand(1, 10),
                'boot_count' => rand(1, 10),
                'retry_count' => rand(1, 10),
                'debug_bit' => Str::random(6),
                'password' => Str::random(12),
                'wifi_ssid' => Str::random(12),
                'wifi_password' => Str::random(8),
            ],
            [
                'station_id' => 1,
                'device_ip' => '192.168.0.102',
                'server_ip' => '192.168.0.100',
                'server_port' => 9000,
                'dispenser_no' => '1',
                'firmware_version' => 'v'.rand(1, 10),
                'boot_count' => rand(1, 10),
                'retry_count' => rand(1, 10),
                'debug_bit' => Str::random(6),
                'password' => Str::random(12),
                'wifi_ssid' => Str::random(12),
                'wifi_password' => Str::random(8),
            ],
            [
                'station_id' => 1,
                'device_ip' => '192.168.0.103',
                'server_ip' => '192.168.0.100',
                'server_port' => 9000,
                'dispenser_no' => '3',
                'firmware_version' => 'v'.rand(1, 10),
                'boot_count' => rand(1, 10),
                'retry_count' => rand(1, 10),
                'debug_bit' => Str::random(6),
                'password' => Str::random(12),
                'wifi_ssid' => Str::random(12),
                'wifi_password' => Str::random(8),
            ],
        ];

        foreach ($dispensers as $dispenser) {
            Dispenser::create($dispenser);
        }
    }
}
