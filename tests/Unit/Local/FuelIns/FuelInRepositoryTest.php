<?php

use App\Models\FuelIn;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

// Test: Get All fuelins
test('can get all fuelins and response with resource', function () {
    FuelIn::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/local/fuelins');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data');
});

// Test: Get FuelIn by ID
test('can get FuelIn by id and response with resource', function () {
    $fuelIn = FuelIn::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/local/fuelins/{$fuelIn->id}");

    $response->assertStatus(200);
});

// Test: Create FuelIn
test('can create FuelIn and response with resource', function () {
    $fuelInData = FuelIn::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/local/fuelins', $fuelInData);

    $response->assertStatus(201);
});

// Test: Update FuelIn
test('can update FuelIn and response with resource', function () {
    $fuelIn = FuelIn::factory()->create();

    $updatedData = FuelIn::factory()->make([
        'driver_name' => 'Updated Driver Name',
    ])->toArray();

    $response = $this->actingAs($this->user)->put("/api/local/fuelins/{$fuelIn->id}", $updatedData);

    $response->assertStatus(200);
});

// Test: Delete FuelIn
test('can delete FuelIn and response with resource', function () {
    $fuelIn = FuelIn::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/local/fuelins/{$fuelIn->id}");

    $response->assertStatus(200);
});
