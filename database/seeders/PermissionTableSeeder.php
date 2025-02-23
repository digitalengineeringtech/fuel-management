<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create', 'guard_name' => 'api']);
        Permission::create(['name' => 'read', 'guard_name' => 'api']);
        Permission::create(['name' => 'update', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete', 'guard_name' => 'api']);
    }
}
