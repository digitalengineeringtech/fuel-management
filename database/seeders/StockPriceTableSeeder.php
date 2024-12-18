<?php

namespace Database\Seeders;

use App\Models\StockPrice;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StockPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stock_prices = [
            [
                'station_id' => 1,
                'fuel_type_id' => 1,
                'unit_price' => rand(2000, 5000),
                'nozzle_no' => ['01', '02', '03', '04'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'station_id' => 1,
                'fuel_type_id' => 2,
                'unit_price' => rand(2000, 5000),
                'nozzle_no' => ['05', '06', '07', '08'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'station_id' => 1,
                'fuel_type_id' => 3,
                'unit_price' => rand(2000, 5000),
                'nozzle_no' => ['09', '10', '11', '12'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'station_id' => 1,
                'fuel_type_id' => 4,
                'unit_price' => rand(2000, 5000),
                'nozzle_no' => ['13', '14', '15', '16'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'station_id' => 1,
                'fuel_type_id' => 5,
                'unit_price' => rand(2000, 5000),
                'nozzle_no' => ['17', '18', '19', '20'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($stock_prices as $stock_price) {
            StockPrice::create($stock_price);
        }
    }
}
