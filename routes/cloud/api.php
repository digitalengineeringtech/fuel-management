<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cloud\Stations\StationController;
use App\Http\Controllers\Cloud\FuelTypes\FuelTypeController;
use App\Http\Controllers\Cloud\StockPrices\StockPriceController;
use App\Http\Controllers\Cloud\VehicleTypes\VehicleTypeController;

// need to remove this after testing done
Route::get('/', function () {
    return response()->json(['message' => 'Cloud API is working']);
});

// need to move this api resource to middleware auth:sanctum after authentication is implemented
Route::apiResource('stations', StationController::class);
Route::apiResource('fuel_types', FuelTypeController::class);
Route::apiResource('vehicle_types', VehicleTypeController::class);
Route::apiResource('stock_prices', StockPriceController::class);
