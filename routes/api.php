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

// Auth and Users Routes
Route::prefix('users')
    ->group(base_path('routes/auth/api.php'));

// Cloud API Routes
Route::prefix('cloud')
    ->middleware('auth:sanctum')
    ->group(base_path('routes/cloud/api.php'));

// Local API Routes
Route::prefix('local')
    ->middleware('auth:sanctum')
    ->group(base_path('routes/local/api.php'));


