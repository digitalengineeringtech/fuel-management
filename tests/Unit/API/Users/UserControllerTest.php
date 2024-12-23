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




