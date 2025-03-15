<?php

use App\Models\FuelIn;
use App\Repositories\Local\Contracts\FuelIns\FuelInRepositoryInterface;

beforeEach(function () {
    $this->fuelInRepository = $this->mock(FuelInRepositoryInterface::class);
});

it('can get all fuelIns and response with resource', function () {
    $fuelIns = FuelIn::factory()->create();

    $this->fuelInRepository->shouldReceive('getFuelIns')->andReturn($fuelIns);

    $response = $this->fuelInRepository->getFuelIns(request());

    expect($response)->toBe($fuelIns);
});

it('can get fuelIn by id and response with resource', function () {
    $fuelIn = FuelIn::factory()->create();

    $this->fuelInRepository->shouldReceive('getFuelIn')->andReturn($fuelIn);

    $response = $this->fuelInRepository->getFuelIn($fuelIn->id);

    expect($response->id)->toBe($fuelIn->id);
});

it('can create fuelIn and response with resource', function () {
    $fuelIn = FuelIn::factory()->create();

    $this->fuelInRepository->shouldReceive('createFuelIn')->andReturn($fuelIn);

    $response = $this->fuelInRepository->createFuelIn($fuelIn->toArray());

    expect($response->id)->toBe($fuelIn->id);
});

it('can update fuelIn and response with resource', function () {
    $fuelIn = FuelIn::factory()->create();

    $this->fuelInRepository->shouldReceive('updateFuelIn')->andReturn($fuelIn);

    $response = $this->fuelInRepository->updateFuelIn($fuelIn->id, $fuelIn->toArray());

    expect($response->id)->toBe($fuelIn->id);
});

it('can delete fuelIn and response with resource', function () {
    $fuelIn = FuelIn::factory()->create();

    $this->fuelInRepository->shouldReceive('deleteFuelIn')->andReturn(['message' => 'FuelIn deleted successfully']);

    $response = $this->fuelInRepository->deleteFuelIn($fuelIn->id);

    expect($response['message'])->toBe('FuelIn deleted successfully');
});
