<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FuelIn>
 */
class FuelInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tank_id' => 1,
            'station_id' => 1,
            'fuel_type_id' => 1,
            'code' => rand(1, 100),
            'terminal_name' => 'Terminal 1',
            'driver_name' => 'Driver 1',
            'bowser_no' => 'B1',
            'tank_capacity' => 10000,
            'opening_balance' => 5000,
            'current_balance' => 6000,
            'send_balance' => 1000,
            'receive_balance' => 1000,
            'receive_date' => now(),
        ];
    }
}
