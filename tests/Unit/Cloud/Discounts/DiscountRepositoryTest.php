<?php

use App\Models\Discount;
use App\Repositories\Cloud\Contracts\Discounts\DiscountRepositoryInterface;

beforeEach(function () {
    $this->discountRepository = $this->mock(DiscountRepositoryInterface::class);
});

test('can get all discount and response with resource', function () {
    $discount = Discount::factory()->create();

    $this->discountRepository->shouldReceive('getDiscount')->andReturn($discount);

    $response = $this->discountRepository->getDiscount(request());

    expect($response)->toBe($discount);
});

test('can get discount by id and response with resource', function () {
    $discount = Discount::factory()->create();

    $this->discountRepository->shouldReceive('getDiscount')->andReturn($discount);

    $response = $this->discountRepository->getDiscount($discount->id);

    expect($response->id)->toBe($discount->id);
});

test('can create discount and response with resource', function () {
    $discount = Discount::factory()->make();

    $this->discountRepository->shouldReceive('createDiscount')->andReturn($discount);

    $response = $this->discountRepository->createDiscount($discount->toArray());

    expect($response->id)->toBe($discount->id);
    expect($response->name)->toBe($discount->name);
});

test('can update discount and response with resource', function () {
    $discount = Discount::factory()->create();

    $this->discountRepository->shouldReceive('updateDiscount')->andReturn($discount);

    $response = $this->discountRepository->updateDiscount($discount->id, $discount->toArray());

    expect($response->id)->toBe($discount->id);
    expect($response->name)->toBe($discount->name);
});

test('can delete discount and response with resource', function () {
    $discount = Discount::factory()->create();

    $this->discountRepository->shouldReceive('deleteDiscount')->andReturn(['message' => 'discount deleted successfully']);

    $response = $this->discountRepository->deleteDiscount($discount->id);

    expect($response['message'])->toBe('discount deleted successfully');
});
