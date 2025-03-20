<?php

use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('can get all vehicle types and response with resource', function () {
    VehicleType::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/cloud/vehicle-types');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data');
});

test('can get vehicle type by id and response with resource', function () {
    $vehicle_type = VehicleType::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/cloud/vehicle-types/{$vehicle_type->id}");

    $response->assertStatus(200);
});

test('can create vehicle type and response with resource', function () {
    $vehicleTypeData = VehicleType::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/cloud/vehicle-types', $vehicleTypeData);

    $response->assertStatus(201);
});

test('can update vehicle type and response with resource', function () {
    $vehicle_type = VehicleType::factory()->create();

    $updatedData = VehicleType::factory()->make(['name' => 'Updated Vehicle Type'])->toArray();

    $response = $this->actingAs($this->user)->put("/api/cloud/vehicle-types/{$vehicle_type->id}", $updatedData);

    $response->assertStatus(200);
});

test('can delete vehicle type and response with resource', function () {
    $vehicle_type = VehicleType::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/vehicle-types/{$vehicle_type->id}");

    $response->assertStatus(200);
});
