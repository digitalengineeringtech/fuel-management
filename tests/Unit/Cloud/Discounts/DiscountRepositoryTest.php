<?php

use App\Models\Discount;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can get all discounts and response with resource', function () {
    Discount::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/cloud/discounts');

    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

it('can get discount by id and response with resource', function () {
    $discount = Discount::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/cloud/discounts/{$discount->id}");

    $response->assertStatus(200)
             ->assertJsonPath('data.id', $discount->id);
});

it('can create discount and response with resource', function () {
    $discountData = Discount::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/cloud/discounts', $discountData);

    $response->assertStatus(201);
});

it('can update discount and response with resource', function () {
    $discount = Discount::factory()->create();

    $updatedData = Discount::factory()->make(['type' => 'percent'])->toArray();

    $response = $this->actingAs($this->user)->put("/api/cloud/discounts/{$discount->id}", $updatedData);

    $response->assertStatus(200);
});

it('can delete discount and response with resource', function () {
    $discount = Discount::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/discounts/{$discount->id}");

    $response->assertStatus(200);
});
