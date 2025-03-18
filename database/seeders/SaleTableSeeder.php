<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

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
                'tank_id' => 1,
                'voucher_no' => 'VCH123456',
                'cashier_code' => 'C001',
                'car_no' => 'AA-1234',
                'device' => 'web',
                'tank_balance' => 10000,
                'totalizer_liter' => 1000,
                'totalizer_amount' => 200000,
                'device_totalizer_liter' => 1234.567,
                'device_totalizer_amount' => 123456,
                'sale_price' => 3320,
                'sale_liter' => 3.012,
                'total_price' => 10000,
                'is_preset' => false,
                'preset_amount' => 0,
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
                'tank_id' => 1,
                'voucher_no' => 'VCH654321',
                'cashier_code' => 'C002',
                'car_no' => 'BB-5678',
                'device' => 'mobile',
                'tank_balance' => 9996.988,
                'totalizer_liter' => 5003.012,
                'totalizer_amount' => 210000,
                'device_totalizer_liter' => 1234.567,
                'device_totalizer_amount' => 123456,
                'sale_liter' => 3.012,
                'sale_price' => 3320,
                'total_price' => 10000,
                'is_preset' => false,
                'preset_amount' => 0,
                'daily_report_date' => now(),
            ],
        ];

        foreach ($sales as $sale) {
            Sale::create($sale);
        }
    }
}
