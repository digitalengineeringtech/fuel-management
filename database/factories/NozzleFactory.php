<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nozzle>
 */
class NozzleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dispenser_id' => 1,
            'stock_price_id' => 1,
            'nozzle_no' => 02,
            'auto_approve' => true,
            'semi_approve' => false,
            'cashier_approve' => false
        ];
    }
}
