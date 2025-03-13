<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Seeder;

class FuelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuel_types = [
            [
                'tank_id' => 1,
                'name' => '001-Octane Ron(92)',
                'description' => 'Octane Ron(92) fuel type',
            ],
            [
                'tank_id' => 2,
                'name' => '002-Octane Ron(95)',
                'description' => 'Octane Ron(95) fuel type',
            ],
            [
                'tank_id' => 3,
                'name' => '003-Octane Ron(97)',
                'description' => 'Octane Ron(97) fuel type',
            ],
            [
                'tank_id' => 4,
                'name' => '004-Diesel',
                'description' => 'Diesel fuel type',
            ],
            [
                'tank_id' => 5,
                'name' => '005-Premium Diesel',
                'description' => 'Premium Diesel fuel type',
            ],
        ];

        foreach ($fuel_types as $fuel_type) {
            FuelType::create($fuel_type);
        }
    }
}
