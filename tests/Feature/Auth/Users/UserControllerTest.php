<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use function PHPSTORM_META\map;

it('can get all users if the user is login', function(){
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/api/users/all');

    $users = $response->json();

    $this->assertCount(1, $users['data']);
});

it('can get single user with id if the user is login', function(){
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/api/users/show/'. $user->id);

    $user = $response->json();

    $this->assertCount(1, $user);
});

it('can create a new user with roles and permissions', function(){
    $user = User::factory()->create();

    $role = Role::create(['name' => 'cashier', 'guard_name' => 'api']);
    $permission = Permission::create(['name' => 'create', 'guard_name' => 'api']);


    $response = $this->actingAs($user)->post('/api/users/create', [
        'station_id' => 1,
        'name' => 'cashier',
        'email' => 'cashier@gmail.com',
        'phone' => '2222992',
        'password' => "12345678",
        'card_id' => '99992',
        'tank_count' => 8,
        'roles' => [
            [
                'name' => 'cashier',
                'guard_name' => 'api'
            ]
        ],
        'permissions' => [
            [
                'name' => 'create',
                'guard_name' => 'api'
            ]
        ]
    ]);

    $user = $response->json();

    $this->assertDatabaseHas('users', [
        'email' => 'cashier@gmail.com'
    ]);
});

it('can update an existing user with roles and permissions that user id', function(){
    $user = User::factory()->create();

    $role = Role::create(['name' => 'cashier', 'guard_name' => 'api']);
    $permission = Permission::create(['name' => 'create', 'guard_name' => 'api']);
    $permission = Permission::create(['name' => 'read', 'guard_name' => 'api']);

    $user->assignRole($role);
    $user->givePermissionTo($permission);

    $response = $this->actingAs($user)->put('/api/users/update/1', [
        'station_id' => 1,
        'name' => 'cashier',
        'email' => 'cashierupdate@gmail.com',
        'phone' => '2222992',
        'password' => "12345678",
        'card_id' => '99992',
        'tank_count' => 8,
        'roles' => [
            [
                'name' => 'cashier',
                'guard_name' => 'api'
            ]
        ],
        'permissions' => [
            [
                'name' => 'create',
                'guard_name' => 'api'
            ],
            [
                'name' => 'read',
                'guard_name' => 'api'
            ]
        ]
    ]);

    $user = $response->json();

    $this->assertDatabaseHas('users', [
        'email' => 'cashierupdate@gmail.com'
    ]);
});

it('can delete user with that user id', function(){
    $user = User::factory()->create();

    $response = $this->actingAs($user)->delete('/api/users/delete/1');

    $user = $response->json();

    $this->assertDatabaseMissing('users', [
        'email' => 'cashierupdate@gmail.com'
    ]);
});




