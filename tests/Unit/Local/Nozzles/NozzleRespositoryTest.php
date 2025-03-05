<?php

use App\Models\Nozzle;
use App\Repositories\Local\Contracts\Nozzles\NozzleRepositoryInterface;

beforeEach(function () {
    $this->nozzleRepository = $this->mock(NozzleRepositoryInterface::class);
});

it('can get all nozzles and response with resource', function () {
    $nozzles = Nozzle::factory()->create();

    $this->nozzleRepository->shouldReceive('getNozzles')->andReturn($nozzles);

    $response = $this->nozzleRepository->getNozzles(request());

    expect($response)->toBe($nozzles);
});

it('can get nozzle by id and response with resource', function () {
    $nozzle = Nozzle::factory()->create();

    $this->nozzleRepository->shouldReceive('getNozzle')->andReturn($nozzle);

    $response = $this->nozzleRepository->getNozzle($nozzle->id);

    expect($response->id)->toBe($nozzle->id);
    expect($nozzle->device_ip)->toBe($nozzle->device_ip);
});

it('can create nozzle and response with resource', function () {
    $nozzle = Nozzle::factory()->create();

    $this->nozzleRepository->shouldReceive('createNozzle')->andReturn($nozzle);

    $response = $this->nozzleRepository->createNozzle($nozzle->toArray());

    expect($response->id)->toBe($nozzle->id);
    expect($nozzle->device_ip)->toBe($nozzle->device_ip);
});

it('can update nozzle and response with resource', function () {
    $nozzle = Nozzle::factory()->create();

    $this->nozzleRepository->shouldReceive('updateNozzle')->andReturn($nozzle);

    $response = $this->nozzleRepository->updateNozzle($nozzle->id, $nozzle->toArray());

    expect($response->id)->toBe($nozzle->id);
    expect($nozzle->device_ip)->toBe($nozzle->device_ip);
});

it('can delete nozzle and response with resource', function () {
    $nozzle = Nozzle::factory()->create();

    $this->nozzleRepository->shouldReceive('deleteNozzle')->andReturn(['message' => 'Nozzle deleted successfully']);

    $response = $this->nozzleRepository->deleteNozzle($nozzle->id);

    expect($response['message'])->toBe('Nozzle deleted successfully');
});
