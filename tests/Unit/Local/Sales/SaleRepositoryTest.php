<?php

use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

// Test: Get All Sales
test('can get all sales and return success response', function () {
    Sale::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/local/sales');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data');
});

// Test: Get Sale by ID
test('can get sale by id and return success response', function () {
    $sale = Sale::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/local/sales/{$sale->id}");

    $response->assertStatus(200)
        ->assertJsonFragment(['id' => $sale->id]);
});

// Test: Create Sale
test('can create sale and return success response', function () {
    $saleData = Sale::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/local/sales', $saleData);

    $response->assertStatus(201);
});

// Test: Update Sale
test('can update sale and return success response', function () {
    $sale = Sale::factory()->create();

    $updatedData = Sale::factory()->make(['voucher_no' => 'UpdatedVoucherNo'])->toArray();

    $response = $this->actingAs($this->user)->put("/api/local/sales/{$sale->id}", $updatedData);

    $response->assertStatus(200);
});

// Test: Delete Sale
test('can delete sale and return success response', function () {
    $sale = Sale::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/local/sales/{$sale->id}");

    $response->assertStatus(200);
});
