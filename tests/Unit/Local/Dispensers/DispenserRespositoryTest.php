<?php

use App\Models\Dispenser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

// Test: Get All Dispensers
test('can get all dispensers and response with resource', function () {
    Dispenser::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/local/dispensers');

    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

// Test: Get Dispenser by ID
test('can get dispenser by id and response with resource', function () {
    $dispenser = Dispenser::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/local/dispensers/{$dispenser->id}");

    $response->assertStatus(200);
});

// Test: Create Dispenser
test('can create dispenser and response with resource', function () {
    $dispenserData = Dispenser::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/local/dispensers', $dispenserData);

    $response->assertStatus(201);
});

// Test: Update Dispenser
test('can update dispenser and response with resource', function () {
    $dispenser = Dispenser::factory()->create();

    $updatedData = Dispenser::factory()->make(['device_ip' => '192.168.1.1'])->toArray();

    $response = $this->actingAs($this->user)->put("/api/local/dispensers/{$dispenser->id}", $updatedData);

    $response->assertStatus(200);
});

// Test: Delete Dispenser
test('can delete dispenser and response with resource', function () {
    $dispenser = Dispenser::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/local/dispensers/{$dispenser->id}");

    $response->assertStatus(200);
});
