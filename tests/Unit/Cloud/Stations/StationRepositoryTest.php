<?php

use App\Models\Shop;
use App\Models\Station;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('can get all stations and response with resource', function () {
    Station::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/cloud/stations');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data');
});

test('can get station by id and response with resource', function () {
    $station = Station::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/cloud/stations/{$station->id}");

    $response->assertStatus(200);
});

test('can create station and response with resource', function () {
    Storage::fake('public'); // Fake the storage

    $shop = Shop::factory()->create();

    $stationData = [
        'shop_id' => $shop->id,
        'name' => 'Kyaw San 1',
        'license_no' => 'L001',
        'image' => UploadedFile::fake()->image('station.png'),
        'phone_one' => '0123456789',
        'phone_two' => '0123456789',
        'address' => '123 Main St',
        'opening_date' => '2023-01-01',
        'subscribe_year' => 2023,
        'expiry_date' => '2025-01-01',
        'opening_hour' => '6:00 AM',
        'closing_hour' => '10:00 PM',
        'expose_url' => null,
    ];

    $response = $this->actingAs($this->user)->post('/api/cloud/stations', $stationData);

    $this->assertDatabaseHas('stations', [
        'shop_id' => $shop->id,
        'name' => 'Kyaw San 1',
    ]);
});

test('can update station and response with resource', function () {
    Storage::fake('public'); // Fake the storage

    $stationData = [
        'shop_id' => 1,
        'name' => 'Kyaw San 1',
        'license_no' => 'L001',
        'image' => UploadedFile::fake()->image('station.png'),
        'phone_one' => '0123456789',
        'phone_two' => '0123456789',
        'address' => '123 Main St',
        'opening_date' => '2023-01-01',
        'subscribe_year' => 2023,
        'expiry_date' => '2025-01-01',
        'opening_hour' => '6:00 AM',
        'closing_hour' => '10:00 PM',
        'expose_url' => null,
    ];

    $station = Station::factory()->create($stationData);

    $updatedData = [
        'shop_id' => 1,
        'name' => 'Kyaw San 1',
        'license_no' => 'KS001',
        'image' => UploadedFile::fake()->image('station.png'),
        'phone_one' => '0123456789',
        'phone_two' => '0123456789',
        'address' => '123 Main St',
        'opening_date' => '2023-01-01',
        'subscribe_year' => 2023,
        'expiry_date' => '2025-01-01',
        'opening_hour' => '6:00 AM',
        'closing_hour' => '10:00 PM',
        'expose_url' => null,
    ];

    $response = $this->actingAs($this->user)->put("/api/cloud/stations/{$station->id}", $updatedData);

    $response->assertStatus(200);
});

test('can delete station and response with resource', function () {
    $station = Station::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/stations/{$station->id}");

    $response->assertStatus(200);
});
