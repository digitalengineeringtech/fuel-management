<?php

use App\Models\FuelType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can get all fuel types and response with resource', function () {
    FuelType::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/cloud/fuel-types');

    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

it('can get fuel type by id and response with resource', function () {
    $fuel_type = FuelType::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/cloud/fuel-types/{$fuel_type->id}");

    $response->assertStatus(200);
});

it('can create fuel type and response with resource', function () {
    $fuelTypeData = FuelType::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/cloud/fuel-types', $fuelTypeData);

    $response->assertStatus(201);
});

it('can update fuel type and response with resource', function () {
    $fuel_type = FuelType::factory()->create();

    $updatedData = FuelType::factory()->make(['name' => 'Updated Fuel Type'])->toArray();

    $response = $this->actingAs($this->user)->put("/api/cloud/fuel-types/{$fuel_type->id}", $updatedData);

    $response->assertStatus(200);
});

it('can delete fuel type and response with resource', function () {
    $fuel_type = FuelType::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/fuel-types/{$fuel_type->id}");

    $response->assertStatus(200);
});
