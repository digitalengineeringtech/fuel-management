<?php

use App\Models\VehicleType;
use App\Repositories\Cloud\Contracts\VehicleTypes\VehicleTypeRepositoryInterface;

beforeEach(function () {
    $this->vehicleTypeRepository = $this->mock(VehicleTypeRepositoryInterface::class);
});


test('can get all vehicle types and response with resource', function () {
    $vehicle_types = VehicleType::factory()->create();

    $this->vehicleTypeRepository->shouldReceive('getVehicleTypes')->andReturn($vehicle_types);

    $response = $this->vehicleTypeRepository->getVehicleTypes(request());

    expect($response)->toBe($vehicle_types);
});

test('can get vehicle type by id and response with resource', function () {
    $vehicle_type = VehicleType::factory()->create();

    $this->vehicleTypeRepository->shouldReceive('getVehicleType')->andReturn($vehicle_type);

    $response = $this->vehicleTypeRepository->getVehicleType($vehicle_type->id);

    expect($response->id)->toBe($vehicle_type->id);
});

test('can create vehicle type and response with resource', function () {
    $vehicle_type = VehicleType::factory()->make();

    $this->vehicleTypeRepository->shouldReceive('createVehicleType')->andReturn($vehicle_type);

    $response = $this->vehicleTypeRepository->createVehicleType($vehicle_type->toArray());

    expect($response->id)->toBe($vehicle_type->id);
    expect($response->name)->toBe($vehicle_type->name);
});

test('can update vehicle type and response with resource', function () {
    $vehicle_type = VehicleType::factory()->create();

    $this->vehicleTypeRepository->shouldReceive('updateVehicleType')->andReturn($vehicle_type);

    $response = $this->vehicleTypeRepository->updateVehicleType($vehicle_type->id, $vehicle_type->toArray());

    expect($response->id)->toBe($vehicle_type->id);
    expect($response->name)->toBe($vehicle_type->name);
});

test('can delete vehicle type and response with resource', function () {
    $vehicle_type = VehicleType::factory()->create();

    $this->vehicleTypeRepository->shouldReceive('deleteVehicleType')->andReturn(['message' => 'Vehicle Type deleted successfully']);

    $response = $this->vehicleTypeRepository->deleteVehicleType($vehicle_type->id);

    expect($response['message'])->toBe('Vehicle Type deleted successfully');
});
