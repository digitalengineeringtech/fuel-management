<?php

use App\Models\Tank;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

// Test: Get All Tanks
test('can get all tanks and return success response', function () {
    Tank::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/local/tanks');

    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

// Test: Get Tank by ID
test('can get tank by id and return success response', function () {
    $tank = Tank::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/local/tanks/{$tank->id}");

    $response->assertStatus(200)
             ->assertJsonFragment(['id' => $tank->id]);
});

// Test: Create Tank
test('can create tank and return success response', function () {
    $tankData = Tank::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/local/tanks', $tankData);

    $response->assertStatus(201);
});

// Test: Update Tank
test('can update tank and return success response', function () {
    $tank = Tank::factory()->create();

    $updatedData = Tank::factory()->make([
        'level' => 5000
    ])->toArray();

    $response = $this->actingAs($this->user)->put("/api/local/tanks/{$tank->id}", $updatedData);

    $response->assertStatus(200);
});

// Test: Delete Tank
test('can delete tank and return success response', function () {
    $tank = Tank::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/local/tanks/{$tank->id}");

    $response->assertStatus(200);
});

