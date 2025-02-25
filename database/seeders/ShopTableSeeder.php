<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = [
            [
                'name' => 'Kyaw San',
                'image' => 'https://via.placeholder.com/150',
                'address' => 'Address 1',
            ],
            [
                'name' => 'Zion',
                'image' => 'https://via.placeholder.com/150',
                'address' => 'Address 2',
            ],
            [
                'name' => 'Shwe Sin Sett Kyar',
                'image' => 'https://via.placeholder.com/150',
                'address' => 'Address 3',
            ],
        ];

        foreach ($shops as $shop) {
            Shop::create($shop);
        }
    }
}
