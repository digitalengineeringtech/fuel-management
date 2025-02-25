<?php

use App\Models\StockPrice;
use App\Repositories\Cloud\Contracts\StockPrices\StockPriceRepositoryInterface;

beforeEach(function () {
    $this->stockPriceRepository = $this->mock(StockPriceRepositoryInterface::class);
});

test('can get all stock prices and response with resource', function () {
    $stock_prices = StockPrice::factory()->create();

    $this->stockPriceRepository->shouldReceive('getStockPrices')->andReturn($stock_prices);

    $response = $this->stockPriceRepository->getStockPrices(request());

    expect($response)->toBe($stock_prices);
});

test('can get stock price by id and response with resource', function () {
    $stock_price = StockPrice::factory()->create();

    $this->stockPriceRepository->shouldReceive('getStockPrice')->andReturn($stock_price);

    $response = $this->stockPriceRepository->getStockPrice($stock_price->id);

    expect($response->id)->toBe($stock_price->id);
});

test('can create stock price and response with resource', function () {
    $stock_price = StockPrice::factory()->make();

    $this->stockPriceRepository->shouldReceive('createStockPrice')->andReturn($stock_price);

    $response = $this->stockPriceRepository->createStockPrice($stock_price->toArray());

    expect($response->id)->toBe($stock_price->id);
    expect($response->name)->toBe($stock_price->name);
});

test('can update stock price and response with resource', function () {
    $stock_price = StockPrice::factory()->create();

    $this->stockPriceRepository->shouldReceive('updateStockPrice')->andReturn($stock_price);

    $response = $this->stockPriceRepository->updateStockPrice($stock_price->id, $stock_price->toArray());

    expect($response->id)->toBe($stock_price->id);
    expect($response->name)->toBe($stock_price->name);
});

test('can delete stock price and response with resource', function () {
    $stock_price = StockPrice::factory()->create();

    $this->stockPriceRepository->shouldReceive('deleteStockPrice')->andReturn(['message' => 'Stock Price deleted successfully']);

    $response = $this->stockPriceRepository->deleteStockPrice($stock_price->id);

    expect($response['message'])->toBe('Stock Price deleted successfully');
});
