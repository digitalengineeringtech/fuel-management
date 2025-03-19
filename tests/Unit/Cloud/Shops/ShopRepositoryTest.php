<?php

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('can get all shops and response with resource', function () {
    Shop::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/cloud/shops');

    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

test('can get shop by id and response with resource', function () {
    $shop = Shop::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/cloud/shops/{$shop->id}");

    $response->assertStatus(200);
});

test('can create shop and response with resource', function () {
    Storage::fake('public'); // Fake the storage

    $shopData = [
        'name' => 'Test Shop',
        'image' => UploadedFile::fake()->image('shop.png'),
        'address' => '123 Main St',
    ];

    $shop = Shop::factory()->make($shopData)->toArray();

    $response = $this->actingAs($this->user)->post('/api/cloud/shops', $shopData);

    $response->assertStatus(201);
});

test('can update shop and response with resource', function () {
    Storage::fake('public'); // Fake the storage

    $shopData = [
        'name' => 'Test Shop',
        'image' => UploadedFile::fake()->image('shop.png'),
        'address' => '123 Main St',
    ];

    $shop = Shop::factory()->create($shopData);

    $updatedData = [
        'name' => 'Updated Shop',
        'image' => UploadedFile::fake()->image('shop.png'),
        'address' => '456 Main St',
    ];

    $response = $this->actingAs($this->user)->put("/api/cloud/shops/{$shop->id}", $updatedData);

    $response->assertStatus(200);
});

test('can delete shop and response with resource', function () {
    $shop = Shop::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/shops/{$shop->id}");

    $response->assertStatus(200);
});
