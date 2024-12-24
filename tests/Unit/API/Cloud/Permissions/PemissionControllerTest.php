<?php

use App\Models\User;
use App\Models\Permission;

it('can get all permissions', function() {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/api/users/permissions');

    $permissions = $response->json();

    expect($permissions)->toBeArray();
});

it('can create a new permission', function() {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/api/users/permissions', [
        'user_id' => $user->id,
        'name' => 'management'
    ]);

    $permissions = $response->json();

    expect($permissions)->toBeArray();
});

it('can update a existing permission', function() {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->put('/api/users/permissions/1', [
        'user_id' => $user->id,
        'name' => 'management'
    ]);

    $permissions = $response->json();

    expect($permissions)->toBeArray();
});

it('can delete a existing permission', function() {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->put('/api/users/permissions/1', [
        'user_id' => $user->id,
        'name' => 'management'
    ]);

    $permissions = $response->json();

    expect($permissions)->toBeArray();
});

