<?php

use App\Models\User;

it('can get all users if the user is login', function(){
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/api/users/all');

    expect($response->json())->toBeArray();
});

it('can get single user with id if the user is login', function(){
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/api/users/show/'. $user->id);

    $user = $response->json();

    expect($user['data'])->toBeArray();
});

it('can create a new user', function(){
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/api/users/create', [
        'station_id' => 1,
        'name' => 'cashier',
        'email' => 'cashier@gmail.com',
        'phone' => '2222992',
        'password' => "12345678",
        'card_id' => '99992',
        'tank_count' => 8,
        'role' => 'cashier'
    ]);

    $user = $response->json();

    expect($user['data'])->toBeArray();
});

it('can update an existing user with that user id', function(){
    $user = User::factory()->create();

    $response = $this->actingAs($user)->put('/api/users/update/1', [
        'station_id' => 1,
        'name' => 'cashier1',
        'email' => 'cashier1@gmail.com',
        'phone' => '2222992',
        'password' => "12345678",
        'card_id' => '99992',
        'tank_count' => 8,
        'role' => 'cashier'
    ]);

    $user = $response->json();

    expect($user['data'])->toBeArray();
});

it('can delete user with that user id', function(){
    $user = User::factory()->create();

    $response = $this->actingAs($user)->delete('/api/users/delete/1');

    $user = $response->json();

    expect($user)->toBeArray()->toHaveKey('message');
});




