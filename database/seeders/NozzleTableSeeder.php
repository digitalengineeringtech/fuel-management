<?php

namespace Database\Seeders;

use App\Models\Nozzle;
use Illuminate\Database\Seeder;

class NozzleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nozzles = [
            [
                'dispenser_id' => 1,
                'stock_price_id' => 1,
                'nozzle_no' => 01,
                'auto_approve' => true,
                'semi_approve' => false,
                'cashier_approve' => false,
            ],
            [
                'dispenser_id' => 1,
                'stock_price_id' => 1,
                'nozzle_no' => 02,
                'auto_approve' => true,
                'semi_approve' => false,
                'cashier_approve' => false,
            ],
        ];

        foreach ($nozzles as $nozzle) {
            Nozzle::create($nozzle);
        }
    }
}
