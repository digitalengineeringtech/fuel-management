<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can get all permissions', function () {
    DB::table('permissions')->insert([
        ['name' => 'view-users', 'guard_name' => 'api'],
        ['name' => 'edit-users', 'guard_name' => 'api'],
        ['name' => 'delete-users', 'guard_name' => 'api'],
    ]);

    $response = $this->actingAs($this->user)->get('/api/users/permissions');

    $permissions = $response->json();

    $this->assertCount(3, $permissions['data']);
});

it('can get a single permission by id', function () {
    $permissionId = DB::table('permissions')->insertGetId([
        'name' => 'view-users', 'guard_name' => 'api',
    ]);

    $response = $this->actingAs($this->user)->get("/api/users/permissions/{$permissionId}");

    $permission = $response->json();

    $this->assertArrayHasKey('data', $permission);
});

it('can create a new permission', function () {
    $response = $this->actingAs($this->user)->post('/api/users/permissions', [
        'name' => 'create-users',
        'guard_name' => 'api',
    ]);

    $this->assertDatabaseHas('permissions', [
        'name' => 'create-users',
    ]);
});

it('can update an existing permission', function () {
    $permissionId = DB::table('permissions')->insertGetId([
        'name' => 'view-users', 'guard_name' => 'api',
    ]);

    $response = $this->actingAs($this->user)->put("/api/users/permissions/{$permissionId}", [
        'name' => 'view-all-users',
        'guard_name' => 'api',
    ]);

    $this->assertDatabaseHas('permissions', [
        'name' => 'view-all-users',
    ]);
});

it('can delete an existing permission', function () {
    $permissionId = DB::table('permissions')->insertGetId([
        'name' => 'view-users', 'guard_name' => 'api',
    ]);

    $response = $this->actingAs($this->user)->delete("/api/users/permissions/{$permissionId}");

    $this->assertDatabaseMissing('permissions', [
        'name' => 'view-users',
    ]);
});
