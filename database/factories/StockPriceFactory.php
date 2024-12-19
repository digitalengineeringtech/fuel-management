<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockPrice>
 */
class StockPriceFactory extends Factory
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
            'fuel_type_id' => 1,
            'nozzle_no' => json_encode([1, 2, 3]),
            'unit_price' => rand(1000, 5555),
        ];
    }
}
