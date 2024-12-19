<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Station>
 */
class StationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_id' => rand(1,3),
            'name' => fake()->name(),
            'station_no' => rand(000001, 999999),
            'image' => fake()->imageUrl(500, 500),
            'phone_one' => fake()->phoneNumber(),
            'phone_two' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'opening_date' => fake()->date(),
            'subscribe_year' => fake()->year(),
            'expiry_date' => fake()->date(),
            'opening_hour' => fake()->time(),
            'closing_hour' => fake()->time(),
        ];
    }
}
