<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cloud\Shops\ShopController;
use App\Http\Controllers\Cloud\Members\MemberController;
use App\Http\Controllers\Cloud\Payments\PaymentController;
use App\Http\Controllers\Cloud\Stations\StationController;
use App\Http\Controllers\Cloud\Customers\CustomerController;
use App\Http\Controllers\Cloud\Discounts\DiscountController;
use App\Http\Controllers\Cloud\FuelTypes\FuelTypeController;
use App\Http\Controllers\Cloud\StockPrices\StockPriceController;
use App\Http\Controllers\Cloud\VehicleTypes\VehicleTypeController;

// need to remove this after testing done
Route::get('/', function () {
    return response()->json(['message' => 'Cloud API is working']);
});

Route::apiResource('shops', ShopController::class);
Route::apiResource('members', MemberController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('stations', StationController::class);
Route::apiResource('discounts', DiscountController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('fuel-types', FuelTypeController::class);
Route::apiResource('stock-prices', StockPriceController::class);
Route::apiResource('vehicle-types', VehicleTypeController::class);
