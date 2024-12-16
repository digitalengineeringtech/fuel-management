<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cloud\Stations\StationController;

// Route::middleware('auth:sanctum')->group(function(){
//     // Cloud API Routes goes here
// });

// need to remove this after testing done
Route::get('/', function () {
    return response()->json(['message' => 'Cloud API is working']);
});

// need to move this api resource to middleware auth:sanctum after authentication is implemented
Route::apiResource('stations', StationController::class);
