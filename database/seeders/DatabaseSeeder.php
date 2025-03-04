<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Dispenser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            ShopTableSeeder::class,
            StationTableSeeder::class,
            RolePermissionTableSeeder::class,
            UserTableSeeder::class,
            VehicleTypeTableSeeder::class,
            FuelTypeTableSeeder::class,
            StockPriceTableSeeder::class,
            DispenserTableSeeder::class,
            NozzleTableSeeder::class
        ]);
    }
}
