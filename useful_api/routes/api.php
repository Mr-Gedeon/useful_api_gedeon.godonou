<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ModuleController;
use App\Http\Middleware\CheckModuleActive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* GENERAL API CALL (ALWAYS ACCESSIBLE) */
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

/* ROUTE ACCESSIBLE ONLY WITH A TOKEN */
Route::middleware(['auth:sanctum'])->group(function () {

    /* activation/desactivation of modules for a user */
    Route::post('/modules/{id}/activate', [ModuleController::class, 'activate']);
    Route::post('/modules/{id}/deactivate', [ModuleController::class, 'deactivate']);

    /* ROUTE ACCESSIBLE ONLY IF THE DESIRED MODULE IS ACTIVATED */
    Route::middleware(CheckModuleActive::class)->group(function () {

        Route::get('/test/{id}');
    });
});
