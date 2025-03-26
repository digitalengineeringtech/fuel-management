<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Traits\HasGenerate;
use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    use HasGenerate;

    public function run(): void
    {
        $shops = [
            [
                'name' => 'Kyaw San',
                'image' => 'https://via.placeholder.com/150',
                'code' => $this->generateShopNumber('Kyaw San'),
                'address' => 'Address 1',
                'importer_name' => 'Kyaw San',
                'importer_company' => 'Kyaw San Company',
            ],
            [
                'name' => 'Zion',
                'code' => $this->generateShopNumber('Zion'),
                'image' => 'https://via.placeholder.com/150',
                'address' => 'Address 2',
                'importer_name' => 'Zion',
                'importer_company' => 'Zion Company',
            ],
            [
                'name' => 'Shwe Sin Sett Kyar',
                'code' => $this->generateShopNumber('Shwe Sin Sett Kyar'),
                'image' => 'https://via.placeholder.com/150',
                'address' => 'Address 3',
                'importer_name' => 'Shwe Sin Sett Kyar',
                'importer_company' => 'Shwe Sin Sett Kyar Company',
            ],
        ];

        foreach ($shops as $shop) {
            Shop::create($shop);
        }
    }
}
