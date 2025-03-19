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

Route::group(['middleware' => 'guest'], function () {
    // Users Register Route
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

    // Users Login Route
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Logout Route
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Users Routed
    Route::get('all', GetUsersController::class)->name('users.all');
    Route::get('show/{id}', GetUserController::class)->name('users.show');
    Route::post('create', CreateUserController::class)->name('users.create');
    Route::put('update/{id}', UpdateUserController::class)->name('users.update');
    Route::delete('delete/{id}', DeleteUserController::class)->name('users.delete');

    // User Roles and Permissions Routes
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    // User Roles and Permissions Revoke Routes
    Route::delete('{userId}/roles/{roleId}', RemoveRoleFromUserController::class)->name('users.roles.revoke');
    Route::delete('{userId}/permissions/{permissionId}', RemovePermissionFromUserController::class)->name('users.permissions.revoke');
    Route::delete('roles/{roleId}/permissions/{permissionId}', RemovePermissionFromRoleController::class)->name('roles.permissions.revoke');
});
