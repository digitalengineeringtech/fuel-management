<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicle_types = [
            ['name' => 'Cycle', 'description' => 'A two-wheeled manual vehicle.'],
            ['name' => 'Cycle 3 wheels', 'description' => 'A tricycle, often used for stability.'],
            ['name' => 'Car', 'description' => 'A small motor vehicle for personal use.'],
            ['name' => 'Bus (City)', 'description' => 'A public transport vehicle for city routes.'],
            ['name' => 'Bus (High Way)', 'description' => 'A bus designed for long-distance highway travel.'],
            ['name' => 'Light Truck (City)', 'description' => 'A small truck used for city deliveries.'],
            ['name' => 'Light Truck (High Way)', 'description' => 'A light truck suitable for highway use.'],
            ['name' => 'Heavy Truck (City)', 'description' => 'A large truck used for city transport.'],
            ['name' => 'Heavy Truck (High Way)', 'description' => 'A heavy-duty truck for highway transport.'],
            ['name' => 'Trailer', 'description' => 'A vehicle used to transport goods.'],
            ['name' => 'Trailer (High Way)', 'description' => 'A highway-compatible trailer for goods transport.'],
            ['name' => 'Htawlargyi', 'description' => 'A large commercial truck used in Myanmar.'],
            ['name' => 'Tractor', 'description' => 'A farming vehicle for agricultural tasks.'],
            ['name' => 'Small Tractor', 'description' => 'A compact tractor for smaller agricultural tasks.'],
            ['name' => 'Heavy Machinery', 'description' => 'Large machinery for industrial or construction use.'],
            ['name' => 'Commercial Vehicle', 'description' => 'Vehicles designed for business or logistics purposes.'],
            ['name' => 'Phone Tower', 'description' => 'A tower structure supporting telecommunication equipment.'],
            ['name' => 'Industrial Zone', 'description' => 'A designated area for industrial operations.'],
            ['name' => 'Generator (Industry)', 'description' => 'A generator used for powering industries.'],
            ['name' => 'Agriculture Machine', 'description' => 'Machinery used in farming and agricultural tasks.'],
            ['name' => 'Generator (Home Use)', 'description' => 'A portable generator for residential power backup.'],
            ['name' => 'Hospital', 'description' => 'A facility providing medical care.'],
            ['name' => 'School', 'description' => 'An educational institution for learning.'],
            ['name' => 'Super Market', 'description' => 'A large store for groceries and other goods.'],
            ['name' => 'Hotel', 'description' => 'A place providing lodging and services for travelers.'],
            ['name' => 'Housing', 'description' => 'Residential buildings for accommodation.'],
            ['name' => 'Boat', 'description' => 'A watercraft for transportation or leisure activities.'],
        ];

        foreach ($vehicle_types as $vehicle_type) {
            VehicleType::create($vehicle_type);
        }
    }
}
