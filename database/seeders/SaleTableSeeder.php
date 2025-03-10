<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = [
            [
                'station_id' => 1,
                'dispenser_id' => 1,
                'nozzle_id' => 1,
                'fuel_type_id' => 1,
                'payment_id' => 1,
                'discount_id' => 1,
                'customer_id' => 1,
                'vehicle_type_id' => 1,
                'tank_no' => 'T1',
                'voucher_no' => 'VCH123456',
                'cashier_code' => 'C001',
                'car_no' => 'AA-1234',
                'device' => 'web',
                'tank_balance' => 5000.50,
                'totalizer_liter' => 1000.75,
                'totalizer_amount' => 200000.00,
                'device_totalizer_liter' => 950.30,
                'device_totalizer_amount' => 190000.00,
                'sale_price' => 2500,
                'sale_liter' => 20,
                'total_price' => 50000,
                'daily_report_date' => now(),
            ],
            [
                'station_id' => 1,
                'dispenser_id' => 1,
                'nozzle_id' => 1,
                'fuel_type_id' => 1,
                'payment_id' => 1,
                'discount_id' => 1,
                'customer_id' => 1,
                'vehicle_type_id' => 1,
                'tank_no' => 'T2',
                'voucher_no' => 'VCH654321',
                'cashier_code' => 'C002',
                'car_no' => 'BB-5678',
                'device' => 'mobile',
                'tank_balance' => 3000.75,
                'totalizer_liter' => 800.25,
                'totalizer_amount' => 150000.00,
                'device_totalizer_liter' => 780.50,
                'device_totalizer_amount' => 140000.00,
                'sale_price' => 2800,
                'sale_liter' => 25,
                'total_price' => 70000,
                'daily_report_date' => now(),
            ]
        ];

        foreach($sales as $sale) {
            Sale::create($sale);
        }
    }
}
