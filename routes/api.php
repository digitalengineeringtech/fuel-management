<?php

use Illuminate\Support\Facades\Route;

// Cloud API Routes
Route::prefix('cloud')
    ->middleware(['api'])
    ->group(base_path('routes/cloud/api.php'));

// Local API Routes

// Require Authentication Routes (Sanctum)
require __DIR__.'/auth.php';
