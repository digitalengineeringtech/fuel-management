<?php

namespace Tests\Unit\Local\Sales;

use App\Models\Sale;
use App\Repositories\Local\Contracts\Sales\SaleRepositoryInterface;

beforeEach(function () {
    $this->saleRepository = $this->mock(SaleRepositoryInterface::class);
});

it('can get all sales and response with resource', function () {
    $sales = Sale::factory()->create();

    $this->saleRepository->shouldReceive('getSales')->andReturn($sales);

    $response = $this->saleRepository->getSales(request());

    expect($response)->toBe($sales);
});

it('can get sale by id and response with resource', function () {
    $sale = Sale::factory()->create();

    $this->saleRepository->shouldReceive('getSale')->andReturn($sale);

    $response = $this->saleRepository->getSale($sale->id);

    expect($response->id)->toBe($sale->id);
    expect($sale->device_ip)->toBe($sale->device_ip);
});

it('can create sale and response with resource', function () {
    $sale = Sale::factory()->create();

    $this->saleRepository->shouldReceive('createSale')->andReturn($sale);

    $response = $this->saleRepository->createSale($sale->toArray());

    expect($response->id)->toBe($sale->id);
});

it('can update sale and response with resource', function () {
    $sale = Sale::factory()->create();

    $this->saleRepository->shouldReceive('updateSale')->andReturn($sale);

    $response = $this->saleRepository->updateSale($sale->id, $sale->toArray());

    expect($response->id)->toBe($sale->id);
});

it('can delete sale and response with resource', function () {
    $sale = Sale::factory()->create();

    $this->saleRepository->shouldReceive('deleteSale')->andReturn(['message' => 'Sale deleted successfully']);

    $response = $this->saleRepository->deleteSale($sale->id);

    expect($response['message'])->toBe('Sale deleted successfully');
});
