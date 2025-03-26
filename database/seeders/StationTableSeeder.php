<?php

namespace Database\Seeders;

use App\Models\Station;
use App\Traits\HasGenerate;
use Illuminate\Database\Seeder;

class StationTableSeeder extends Seeder
{
    use HasGenerate;

    public function run(): void
    {
        $station = Station::create([
            'shop_id' => 1,
            'name' => 'Kyaw San 1',
            'station_no' => $this->generateStationNumber(1),
            'license_no' => 'L001',
            'image' => null,
            'phone_one' => '0123456789',
            'phone_two' => '0123456789',
            'address' => '123 Main St',
            'opening_date' => '2023-01-01',
            'subscribe_year' => 2023,
            'expiry_date' => '2025-01-01',
            'opening_hour' => '6:00 AM',
            'closing_hour' => '10:00 PM',
            'station_database' => $this->generateDatabaseName($this->generateStationNumber(1)),
            'expose_url' => null,
        ]);
    }
}
