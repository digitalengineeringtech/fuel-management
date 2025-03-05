<?php

use App\Http\Controllers\Local\Dispensers\DispenserController;
use App\Http\Controllers\Local\Nozzles\NozzleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Local API is working']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('nozzles', NozzleController::class);
    Route::apiResource('dispensers', DispenserController::class);
});
