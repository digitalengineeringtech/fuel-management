<?php

use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
    Storage::fake();

    $vehicleTypeData = VehicleType::factory()->make()->toArray();

    $vehicleTypeData['image'] = UploadedFile::fake()->image('vehicle-type.png');

    $response = $this->actingAs($this->user)->post('/api/cloud/vehicle-types', $vehicleTypeData);

    $response->assertStatus(201);
});

test('can update vehicle type and response with resource', function () {
    Storage::fake();

    $vehicle_type = VehicleType::factory()->create();

    $updatedData = VehicleType::factory()->make(['name' => 'GG'])->toArray();

    $updatedData['image'] = UploadedFile::fake()->image('vehicle-type.png');

    $response = $this->actingAs($this->user)->put("/api/cloud/vehicle-types/{$vehicle_type->id}", $updatedData);

    $response->assertStatus(200);
});

test('can delete vehicle type and response with resource', function () {
    $vehicle_type = VehicleType::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/vehicle-types/{$vehicle_type->id}");

    $response->assertStatus(200);
});
