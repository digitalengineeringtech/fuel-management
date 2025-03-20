<?php

use App\Models\Nozzle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

// Test: Get All nozzles
test('can get all nozzles and response with resource', function () {
    Nozzle::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/local/nozzles');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data');
});

// Test: Get Nozzle by ID
test('can get Nozzle by id and response with resource', function () {
    $nozzle = Nozzle::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/local/nozzles/{$nozzle->id}");

    $response->assertStatus(200);
});

// Test: Create Nozzle
test('can create Nozzle and response with resource', function () {
    $nozzleData = Nozzle::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/local/nozzles', $nozzleData);

    $response->assertStatus(201);
});

// Test: Update Nozzle
test('can update Nozzle and response with resource', function () {
    $nozzle = Nozzle::factory()->create();

    $updatedData = Nozzle::factory()->make([
        'auto_approve' => true,
    ])->toArray();

    $response = $this->actingAs($this->user)->put("/api/local/nozzles/{$nozzle->id}", $updatedData);

    $response->assertStatus(200);
});

// Test: Delete Nozzle
test('can delete Nozzle and response with resource', function () {
    $nozzle = Nozzle::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/local/nozzles/{$nozzle->id}");

    $response->assertStatus(200);
});
