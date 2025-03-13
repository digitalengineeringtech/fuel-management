<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Local\FuelIns\FuelInController;
use App\Http\Controllers\Local\Nozzles\NozzleController;
use App\Http\Controllers\Local\Dispensers\DispenserController;
use App\Http\Controllers\Local\Tanks\TankController;

Route::get('/', function () {
    return response()->json(['message' => 'Local API is working']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('tanks', TankController::class);
    Route::apiResource('fuelins', FuelInController::class);
    Route::apiResource('nozzles', NozzleController::class);
    Route::apiResource('dispensers', DispenserController::class);
});
