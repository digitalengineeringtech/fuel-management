<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Local\Customers\CustomerController;
use App\Http\Controllers\Local\Members\MemberController;

Route::apiResource('customers', CustomerController::class);
Route::apiResource('members', MemberController::class);
