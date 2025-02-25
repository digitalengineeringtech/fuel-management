<?php

use App\Models\FuelType;
use App\Repositories\Cloud\Contracts\FuelTypes\FuelTypeRepositoryInterface;

beforeEach(function () {
    $this->fuelTypeRepository = $this->mock(FuelTypeRepositoryInterface::class);
});

test('can get all fuel types and response with resource', function () {
    $fuel_types = FuelType::factory()->create();

    $this->fuelTypeRepository->shouldReceive('getFuelTypes')->andReturn($fuel_types);

    $response = $this->fuelTypeRepository->getFuelTypes(request());

    expect($response)->toBe($fuel_types);
});

test('can get fuel type by id and response with resource', function () {
    $fuel_type = FuelType::factory()->create();

    $this->fuelTypeRepository->shouldReceive('getFuelType')->andReturn($fuel_type);

    $response = $this->fuelTypeRepository->getFuelType($fuel_type->id);

    expect($response->id)->toBe($fuel_type->id);
});

test('can create fuel type and response with resource', function () {
    $fuel_type = FuelType::factory()->make();

    $this->fuelTypeRepository->shouldReceive('createFuelType')->andReturn($fuel_type);

    $response = $this->fuelTypeRepository->createFuelType($fuel_type->toArray());

    expect($response->id)->toBe($fuel_type->id);
    expect($response->name)->toBe($fuel_type->name);
});

test('can update fuel type and response with resource', function () {
    $fuel_type = FuelType::factory()->create();

    $this->fuelTypeRepository->shouldReceive('updateFuelType')->andReturn($fuel_type);

    $response = $this->fuelTypeRepository->updateFuelType($fuel_type->id, $fuel_type->toArray());

    expect($response->id)->toBe($fuel_type->id);
    expect($response->name)->toBe($fuel_type->name);
});

test('can delete fuel type and response with resource', function () {
    $fuel_type = FuelType::factory()->create();

    $this->fuelTypeRepository->shouldReceive('deleteFuelType')->andReturn(['message' => 'Fuel Type deleted successfully']);

    $response = $this->fuelTypeRepository->deleteFuelType($fuel_type->id);

    expect($response['message'])->toBe('Fuel Type deleted successfully');
});
