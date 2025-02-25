<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can get all roles', function () {
    DB::table('roles')->insert([
        ['name' => 'admin', 'guard_name' => 'api'],
        ['name' => 'manager', 'guard_name' => 'api'],
        ['name' => 'cashier', 'guard_name' => 'api'],
    ]);

    $response = $this->actingAs($this->user)->get('/api/users/roles');

    $roles = $response->json();

    $this->assertCount(3, $roles['data']);
});

it('can get a single role by id', function () {
    $roleId = DB::table('roles')->insertGetId([
        'name' => 'admin', 'guard_name' => 'api',
    ]);

    $response = $this->actingAs($this->user)->get("/api/users/roles/{$roleId}");

    $role = $response->json();

    $this->assertArrayHasKey('data', $role);
});

it('can create a new role', function () {
    $response = $this->actingAs($this->user)->post('/api/users/roles', [
        'name' => 'cashier',
        'guard_name' => 'api',
    ]);

    $this->assertDatabaseHas('roles', [
        'name' => 'cashier',
    ]);
});

it('can update an existing role', function () {
    $roleId = DB::table('roles')->insertGetId([
        'name' => 'admin', 'guard_name' => 'api',
    ]);

    $response = $this->actingAs($this->user)->put("/api/users/roles/{$roleId}", [
        'name' => 'super-admin',
        'guard_name' => 'api',
    ]);

    $this->assertDatabaseHas('roles', [
        'name' => 'super-admin',
    ]);
});

it('can delete an existing role', function () {
    $roleId = DB::table('roles')->insertGetId([
        'name' => 'admin', 'guard_name' => 'api',
    ]);

    $response = $this->actingAs($this->user)->delete("/api/users/roles/{$roleId}");

    $this->assertDatabaseMissing('roles', [
        'name' => 'admin',
    ]);
});
