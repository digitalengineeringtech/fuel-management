<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            [
                'user_id' => 1,
                'name' => 'create',
            ],
            [
                'user_id' => 1,
                'name' => 'edit',
            ],
            [
                'user_id' => 1,
                'name' => 'update',
            ],
            [
                'user_id' => 1,
                'name' => 'delete',
            ]
        ];

        foreach ($permission as $permission) {
            Permission::create($permission);
        }
    }
}
