<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Local\FuelIns\FuelInController;
use App\Http\Controllers\Local\Nozzles\NozzleController;
use App\Http\Controllers\Local\Dispensers\DispenserController;

Route::get('/', function () {
    return response()->json(['message' => 'Local API is working']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('fuelins', FuelInController::class);
    Route::apiResource('nozzles', NozzleController::class);
    Route::apiResource('dispensers', DispenserController::class);
});
