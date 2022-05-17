<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

# Auth
Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);
Route::get('users', function () {
    return response()->json([
        'users' => \App\Models\User::all()
    ]);
});

# Clients
Route::get('clients', [ClientController::class, 'clients']);
Route::get('client/{id}', [ClientController::class, 'getClient']);
Route::post('addClient', [ClientController::class, 'addClient']);
Route::put('editClient/{id}', [ClientController::class, 'updateClient']);
Route::delete('client/{id}', [ClientController::class, 'deleteClient']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthApiController::class, 'logout']);

    # Notifications
    Route::post('addNotifications', [NotificationController::class, 'addNotifications']);
    Route::post('getNotification', [NotificationController::class, 'getNotification']);
    Route::post('getNotifications', [NotificationController::class, 'getPaginatedNotifications']);
});

//    Route::delete('users/{id}', [ControllerExample::class, 'deleteUser']);
