<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Local\Customers\CustomerController;

Route::apiResource('customers', CustomerController::class);
