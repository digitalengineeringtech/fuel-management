<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $user = User::factory()->create([
            'name' => 'admin', // Customize if needed
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0959959955',
            'card_id' => '00001',
            'tank_count' => '8',
            'role' => 'admin'
        ]);

        // Define the permissions
        $permissions = ['create', 'edit', 'update', 'delete'];

        // Assign each permission to the same user
        foreach ($permissions as $permissionName) {
            Permission::factory()->create([
                'user_id' => $user->id,
                'name' => $permissionName,
            ]);
        }
    }
}
