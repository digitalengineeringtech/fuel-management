<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'station_id' => StationFactory::create()->id,
            'dispenser_id' => DispenserFactory::create()->id,
            'nozzle_id' => NozzleFactory::create()->id,
            'fuel_type_id' => FuelTypeFactory::create()->id,
            'payment_id' => PaymentFactory::create()->id,
            'discount_id' => DiscountFactory::factory()->nullable(),
            'customer_id' => CustomerFactory::factory()->nullable(),
            'vehicle_type_id' => VehicleTypeFactory::factory()->nullable(),
            'tank_no' => $this->faker->randomElement(['T1', 'T2', 'T3']),
            'voucher_no' => Str::random(10),
            'cashier_code' => 'C' . rand(100, 999),
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
            'daily_report_date' => now(),
        ];
    }
}
