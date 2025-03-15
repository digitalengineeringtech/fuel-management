<?php

use App\Models\Tank;
use App\Repositories\Local\Contracts\Tanks\TankRepositoryInterface;

beforeEach(function () {
    $this->tankRepository = $this->mock(TankRepositoryInterface::class);
});

it('can get all tanks and response with resource', function () {
    $tanks = Tank::factory()->create();

    $this->tankRepository->shouldReceive('getTanks')->andReturn($tanks);

    $response = $this->tankRepository->getTanks(request());

    expect($response)->toBe($tanks);
});

it('can get tank by id and response with resource', function () {
    $tank = Tank::factory()->create();

    $this->tankRepository->shouldReceive('getTank')->andReturn($tank);

    $response = $this->tankRepository->getTank($tank->id);

    expect($response->id)->toBe($tank->id);
});

it('can create tank and response with resource', function () {
    $tank = Tank::factory()->create();

    $this->tankRepository->shouldReceive('createTank')->andReturn($tank);

    $response = $this->tankRepository->createTank($tank->toArray());

    expect($response->id)->toBe($tank->id);
});

it('can update tank and response with resource', function () {
    $tank = Tank::factory()->create();

    $this->tankRepository->shouldReceive('updateTank')->andReturn($tank);

    $response = $this->tankRepository->updateTank($tank->id, $tank->toArray());

    expect($response->id)->toBe($tank->id);
});

it('can delete tank and response with resource', function () {
    $tank = Tank::factory()->create();

    $this->tankRepository->shouldReceive('deleteTank')->andReturn(['message' => 'Tank deleted successfully']);

    $response = $this->tankRepository->deleteTank($tank->id);

    expect($response['message'])->toBe('Tank deleted successfully');
});
