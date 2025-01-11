<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\Users\GetUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\Users\GetUsersController;
use App\Http\Controllers\Auth\Users\CreateUserController;
use App\Http\Controllers\Auth\Users\DeleteUserController;
use App\Http\Controllers\Auth\Users\UpdateUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Permissions\PermissionController;

Route::post('users/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('users/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('users/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');

Route::get('users/all', GetUsersController::class)
    ->middleware('auth:sanctum')
    ->name('users.all');

Route::get('users/show/{id}', GetUserController::class)
    ->middleware('auth:sanctum')
    ->name('users.show');

Route::post('users/create', CreateUserController::class)
    ->middleware('auth:sanctum')
    ->name('users.create');

Route::put('users/update/{id}', UpdateUserController::class)
    ->middleware('auth:sanctum')
    ->name('users.update');

Route::delete('users/delete/{id}', DeleteUserController::class)
    ->middleware('auth:sanctum')
    ->name('users.delete');

Route::apiResource('users/permissions', PermissionController::class)
    ->middleware('auth:sanctum');
