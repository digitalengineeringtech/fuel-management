<?php

namespace Database\Seeders;

use App\Models\FuelIn;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FuelInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $fuelins = [
            [
                'station_id' => 1,
                'fuel_type_id' => 1,
                'code' => 1,
                'tank_no' => 1,
                'terminal_name' => 'Terminal 1',
                'driver_name' => 'Driver 1',
                'bowser_no' => 'B1',
                'tank_capacity' => 10000,
                'opening_balance' => 5000,
                'current_balance' => 6000,
                'send_balance' => 1000,
                'receive_balance' => 1000,
                'receive_date' => now(),
            ],
            [
                'station_id' => 1,
                'fuel_type_id' => 2,
                'code' => 2,
                'tank_no' => 2,
                'terminal_name' => 'Terminal 1',
                'driver_name' => 'Driver 1',
                'bowser_no' => 'B1',
                'tank_capacity' => 10000,
                'opening_balance' => 5000,
                'current_balance' => 6000,
                'send_balance' => 1000,
                'receive_balance' => 1000,
                'receive_date' => now(),
            ]
         ];

         foreach ($fuelins as $fuelin) {
            FuelIn::create($fuelin);
         }
    }
}
