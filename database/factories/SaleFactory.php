<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
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
            'dispenser_id' => 1,
            'nozzle_id' => 1,
            'fuel_type_id' => 1,
            'payment_id' => 1,
            'discount_id' => 1,
            'customer_id' => 1,
            'vehicle_type_id' => 1,
            'tank_id' => 1,
            'voucher_no' => Str::random(10),
            'cashier_code' => 'C'.rand(100, 999),
            'car_no' => '1F-'.rand(0001, 9999),
            'device' => $this->faker->randomElement(['web', 'mobile', 'tablet']),
            'tank_balance' => $this->faker->randomFloat(3, 0, 10000),
            'totalizer_liter' => $this->faker->randomFloat(3, 0, 10000),
            'totalizer_amount' => $this->faker->randomFloat(3, 0, 100000),
            'device_totalizer_liter' => $this->faker->randomFloat(3, 0, 10000),
            'device_totalizer_amount' => $this->faker->randomFloat(3, 0, 100000),
            'sale_price' => $this->faker->numberBetween(1000, 5000),
            'sale_liter' => $this->faker->numberBetween(1, 100),
            'total_price' => $this->faker->numberBetween(5000, 500000),
            'is_preset' => false,
            'preset_amount' => 0,
            'daily_report_date' => now(),
        ];
    }
}
