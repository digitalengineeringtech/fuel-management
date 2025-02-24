<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('users can authenticate with email and password', function () {
    $user = User::factory()->create();

    $response = $this->post('/api/users/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $responseData = $response->json();

    expect($responseData)->toHaveKeys(['message', 'data']);
    expect($responseData['data'])->toHaveKeys(['token']);
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/api/users/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/api/users/logout');

    expect($response->json())->toHaveKeys(['message']);
});
