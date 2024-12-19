<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cloud\Shops\ShopController;
use App\Http\Controllers\Cloud\Stations\StationController;
use App\Http\Controllers\Cloud\FuelTypes\FuelTypeController;
use App\Http\Controllers\Cloud\StockPrices\StockPriceController;
use App\Http\Controllers\Cloud\VehicleTypes\VehicleTypeController;

// need to remove this after testing done
Route::get('/', function () {
    return response()->json(['message' => 'Cloud API is working']);
});
Route::apiResource('shops', ShopController::class);
Route::apiResource('stations', StationController::class);
Route::apiResource('fuel-types', FuelTypeController::class);
Route::apiResource('vehicle-types', VehicleTypeController::class);
Route::apiResource('stock-prices', StockPriceController::class);
