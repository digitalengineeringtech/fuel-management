<?php

namespace Database\Seeders;

use App\Models\Tank;
use Illuminate\Database\Seeder;

class TankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanks = [
            [
                'station_id' => 1,
                'oil_type' => '92 Octane',
                'state_info' => 'No alarm',
                'volume' => 5000,
                'oil_ratio' => 22,
                'level' => 4999,
                'temperature' => 32.22,
                'weight' => 43,
                'water_ratio' => 0.9,
                'avaliable_oil_weight' => 5000,
            ],
            [
                'station_id' => 1,
                'oil_type' => '95 Octane',
                'state_info' => 'No alarm',
                'volume' => 6000,
                'oil_ratio' => 11,
                'level' => 5999,
                'temperature' => 32.22,
                'weight' => 22,
                'water_ratio' => 0.5,
                'avaliable_oil_weight' => 6000,
            ],
        ];

        foreach ($tanks as $tank) {
            Tank::create($tank);
        }
    }
}
