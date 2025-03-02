<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'api',
            ],
            [
                'id' => 2,
                'name' => 'manager',
                'guard_name' => 'api',
            ],
            [
                'id' => 3,
                'name' => 'user',
                'guard_name' => 'api',
            ],
        ];

        $permissions = [
            [
                'id' => 1,
                'name' => 'create',
                'guard_name' => 'api',
            ],
            [
                'id' => 2,
                'name' => 'read',
                'guard_name' => 'api',
            ],
            [
                'id' => 3,
                'name' => 'update',
                'guard_name' => 'api',
            ],
            [
                'id' => 4,
                'name' => 'delete',
                'guard_name' => 'api',
            ],
        ];

        foreach ($permissions as $permission) {
            $permission = Permission::create($permission);
        }

        foreach ($roles as $role) {
            $role = Role::create($role);
        }

        $role = Role::find(1);

        $role->syncPermissions(Permission::all());
    }
}
