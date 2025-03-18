<?php

use Illuminate\Support\Facades\Route;

//
Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'cloud_url' => url('/api/cloud'),
        'local_url' => url('/api/local'),
    ]);
});

// Cloud API Routes
Route::prefix('cloud')
    // ->middleware('auth:sanctum') // need to uncomment this after testing done
    ->group(base_path('routes/cloud/api.php'));

// Local API Routes
Route::prefix('local')
    // ->middleware('auth:sanctum') // need to uncomment this after testing done
    ->group(base_path('routes/local/api.php'));

// Require Authentication Routes (Sanctum)
require __DIR__.'/auth.php';
