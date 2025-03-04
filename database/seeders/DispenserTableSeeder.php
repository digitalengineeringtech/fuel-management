<?php

namespace Database\Seeders;

use App\Models\Dispenser;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                'firmware_version' => 1,
                'boot_count' => 1,
                'retry_count' => 1,
                'debug_bit' => random_bytes(16),
                'password' => 'password',
                'wifi_ssid' => Str::random(12),
                'wifi_password' => Str::random(8),
            ],
            [
                'station_id' => 1,
                'device_ip' => '192.168.0.102',
                'server_ip' => '192.168.0.100',
                'server_port' => 9000,
                'firmware_version' => 1,
                'boot_count' => 1,
                'retry_count' => 1,
                'debug_bit' => random_bytes(16),
                'password' => 'password',
                'wifi_ssid' => Str::random(12),
                'wifi_password' => Str::random(8),
            ],
            [
                'station_id' => 1,
                'device_ip' => '192.168.0.103',
                'server_ip' => '192.168.0.100',
                'server_port' => 9000,
                'firmware_version' => 1,
                'boot_count' => 1,
                'retry_count' => 1,
                'debug_bit' => random_bytes(16),
                'password' => 'password',
                'wifi_ssid' => Str::random(12),
                'wifi_password' => Str::random(8),
            ]
        ];

        foreach($dispensers as $dispenser) {
            Dispenser::create($dispenser);
        }
    }
}
