<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FuelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuel_types = [
            [
                'name' => '001-Octane Ron(92)',
                'description' => 'Octane Ron(92) fuel type',
            ],
            [
                'name' => '002-Octane Ron(95)',
                'description' => 'Octane Ron(95) fuel type',
            ],
            [
                'name' => '003-Octane Ron(97)',
                'description' => 'Octane Ron(97) fuel type',
            ],
            [
                'name' => '004-Diesel',
                'description' => 'Diesel fuel type',
            ],
            [
                'name' => '005-Premium Diesel',
                'description' => 'Premium Diesel fuel type',
            ],
        ];

        foreach ($fuel_types as $fuel_type) {
            FuelType::create($fuel_type);
        }
    }
}
