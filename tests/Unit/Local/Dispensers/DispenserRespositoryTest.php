<?php

use App\Models\Dispenser;
use App\Repositories\Local\Contracts\Dispensers\DispenserRepositoryInterface;

beforeEach(function () {
    $this->dispenserRepository = $this->mock(DispenserRepositoryInterface::class);
});

it('can get all dispensers and response with resource', function () {
    $dispensers = Dispenser::factory()->create();

    $this->dispenserRepository->shouldReceive('getDispensers')->andReturn($dispensers);

    $response = $this->dispenserRepository->getDispensers(request());

    expect($response)->toBe($dispensers);
});

it('can get dispenser by id and response with resource', function () {
    $dispenser = Dispenser::factory()->create();

    $this->dispenserRepository->shouldReceive('getDispenser')->andReturn($dispenser);

    $response = $this->dispenserRepository->getDispenser($dispenser->id);

    expect($response->id)->toBe($dispenser->id);
    expect($dispenser->device_ip)->toBe($dispenser->device_ip);
});

it('can create dispenser and response with resource', function () {
    $dispenser = Dispenser::factory()->create();

    $this->dispenserRepository->shouldReceive('createDispenser')->andReturn($dispenser);

    $response = $this->dispenserRepository->createDispenser($dispenser->toArray());

    expect($response->id)->toBe($dispenser->id);
    expect($dispenser->device_ip)->toBe($dispenser->device_ip);
});

it('can update dispenser and response with resource', function () {
    $dispenser = Dispenser::factory()->create();

    $this->dispenserRepository->shouldReceive('updateDispenser')->andReturn($dispenser);

    $response = $this->dispenserRepository->updateDispenser($dispenser->id, $dispenser->toArray());

    expect($response->id)->toBe($dispenser->id);
    expect($dispenser->device_ip)->toBe($dispenser->device_ip);
});

it('can delete dispenser and response with resource', function () {
    $dispenser = Dispenser::factory()->create();

    $this->dispenserRepository->shouldReceive('deleteDispenser')->andReturn(['message' => 'Dispenser deleted successfully']);

    $response = $this->dispenserRepository->deleteDispenser($dispenser->id);

    expect($response['message'])->toBe('Dispenser deleted successfully');
});
