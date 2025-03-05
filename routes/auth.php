<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Permissions\PermissionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\Roles\Revokes\RemovePermissionFromRoleController;
use App\Http\Controllers\Auth\Roles\RoleController;
use App\Http\Controllers\Auth\Users\CreateUserController;
use App\Http\Controllers\Auth\Users\DeleteUserController;
use App\Http\Controllers\Auth\Users\GetUserController;
use App\Http\Controllers\Auth\Users\GetUsersController;
use App\Http\Controllers\Auth\Users\Revokes\RemovePermissionFromUserController;
use App\Http\Controllers\Auth\Users\Revokes\RemoveRoleFromUserController;
use App\Http\Controllers\Auth\Users\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'])->group(function () {
    // Users Register Route
    Route::post('users/register', [RegisteredUserController::class, 'store'])->name('register');

    // Users Login Route
    Route::post('users/login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Logout Route
    Route::post('users/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Users Routed
    Route::get('users/all', GetUsersController::class)->name('users.all');
    Route::get('users/show/{id}', GetUserController::class)->name('users.show');
    Route::post('users/create', CreateUserController::class)->name('users.create');
    Route::put('users/update/{id}', UpdateUserController::class)->name('users.update');
    Route::delete('users/delete/{id}', DeleteUserController::class)->name('users.delete');

    // User Roles and Permissions Routes
    Route::apiResource('users/roles', RoleController::class);
    Route::apiResource('users/permissions', PermissionController::class);

    // User Roles and Permissions Revoke Routes
    Route::delete('users/{userId}/roles/{roleId}', RemoveRoleFromUserController::class)->name('users.roles.revoke');
    Route::delete('users/{userId}/permissions/{permissionId}', RemovePermissionFromUserController::class)->name('users.permissions.revoke');
    Route::delete('roles/{roleId}/permissions/{permissionId}', RemovePermissionFromRoleController::class)->name('roles.permissions.revoke');
});
