<?php

use App\Models\StockPrice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('can get all stock prices and response with resource', function () {
    StockPrice::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/cloud/stock-prices');

    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

test('can get stock price by id and response with resource', function () {
    $stock_price = StockPrice::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/cloud/stock-prices/{$stock_price->id}");

    $response->assertStatus(200);
});

test('can create stock price and response with resource', function () {
    $stockPriceData = StockPrice::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/cloud/stock-prices', $stockPriceData);

    $response->assertStatus(201);
});

test('can update stock price and response with resource', function () {
    $stock_price = StockPrice::factory()->create();

    $updatedData = StockPrice::factory()->make(['unit_price' => 4000])->toArray();

    $response = $this->actingAs($this->user)->put("/api/cloud/stock-prices/{$stock_price->id}", $updatedData);

    $response->assertStatus(200);
});

test('can delete stock price and response with resource', function () {
    $stock_price = StockPrice::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/stock-prices/{$stock_price->id}");

    $response->assertStatus(200);
});
