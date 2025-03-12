<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tank>
 */
class TankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'station_id' => StationFactory::create()->id,
            'oil_type' => '92 Octane',
            'state_info' => 'No alarm',
            'volume' => 5000,
            'oil_ratio' => 22,
            'level' => 4999,
            'temperature' => 32.22,
            'weight' => 43,
            'water_ratio' => 0.9,
            'avaliable_oil_weight' => 5000,
        ];
    }
}
