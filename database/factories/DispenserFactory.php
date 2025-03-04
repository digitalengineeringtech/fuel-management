<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dispenser>
 */
class DispenserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
        ];
    }
}
