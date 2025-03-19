<?php

use App\Http\Controllers\Local\Dispensers\DispenserController;
use App\Http\Controllers\Local\FuelIns\FuelInController;
use App\Http\Controllers\Local\Nozzles\NozzleController;
use App\Http\Controllers\Local\Sales\SaleController;
use App\Http\Controllers\Local\Tanks\TankController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Local API is working']);
});

Route::apiResource('tanks', TankController::class);
Route::apiResource('fuelins', FuelInController::class);
Route::apiResource('nozzles', NozzleController::class);
Route::apiResource('dispensers', DispenserController::class);

Route::apiResource('sales', SaleController::class);
Route::post('sales/{type}/preset', [SaleController::class, 'presetSale'])->name('sales.preset');
Route::post('sales/approve-by/cashier', [SaleController::class, 'cashierSale'])->name('sales.cashier');
