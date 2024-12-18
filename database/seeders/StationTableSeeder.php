<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $station = Station::create([
            'name' => 'Station 1',
            'station_no' => 'S001',
            'image' => NULL,
            'phone_one' => '0123456789',
            'phone_two' => '0123456789',
            'address' => '123 Main St',
            'opening_date' => '2023-01-01',
            'subscribe_year' => 2023,
            'expiry_date' => '2025-01-01',
            'opening_hour' => '6:00 AM',
            'closing_hour' => '10:00 PM',
        ]);
    }
}
