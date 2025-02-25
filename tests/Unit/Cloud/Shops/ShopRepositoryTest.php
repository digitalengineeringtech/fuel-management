<?php

use App\Models\Shop;
use App\Repositories\Cloud\Contracts\Shops\ShopRepositoryInterface;

beforeEach(function () {
    $this->shopRepository = $this->mock(ShopRepositoryInterface::class);
});

test('can get all shops and response with resource', function () {
    $shops = Shop::factory()->create();

    $this->shopRepository->shouldReceive('getShops')->andReturn($shops);

    $response = $this->shopRepository->getShops(request());

    expect($response)->toBe($shops);
});

test('can get shop by id and response with resource', function () {
    $shop = Shop::factory()->create();

    $this->shopRepository->shouldReceive('getShop')->andReturn($shop);

    $response = $this->shopRepository->getShop($shop->id);

    expect($response->id)->toBe($shop->id);
});

test('can create shop and response with resource', function () {
    $shop = Shop::factory()->make();

    $this->shopRepository->shouldReceive('createShop')->andReturn($shop);

    $response = $this->shopRepository->createShop($shop->toArray());

    expect($response->id)->toBe($shop->id);
    expect($response->name)->toBe($shop->name);
});

test('can update shop and response with resource', function () {
    $shop = Shop::factory()->create();

    $this->shopRepository->shouldReceive('updateShop')->andReturn($shop);

    $response = $this->shopRepository->updateShop($shop->id, $shop->toArray());

    expect($response->id)->toBe($shop->id);
    expect($response->name)->toBe($shop->name);
});

test('can delete shop and response with resource', function () {
    $shop = Shop::factory()->create();

    $this->shopRepository->shouldReceive('deleteShop')->andReturn(['message' => 'Shop deleted successfully']);

    $response = $this->shopRepository->deleteShop($shop->id);

    expect($response['message'])->toBe('Shop deleted successfully');
});
