<?php

use App\Http\Controllers\Local\Customers\CustomerController;
use App\Http\Controllers\Local\Members\MemberController;
use Illuminate\Support\Facades\Route;

Route::apiResource('customers', CustomerController::class);
Route::apiResource('members', MemberController::class);
