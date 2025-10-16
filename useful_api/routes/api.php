<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ShortlinkController;
use App\Http\Controllers\WalletController;
use App\Http\Middleware\CheckModuleActive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

    /* GENERAL API CALL (ALWAYS ACCESSIBLE) */
    Route::post('register', [RegisteredUserController::class, 'store'])
        ->middleware('guest')
        ->name('register');
    
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest')
        ->name('login');

    Route::get('s/{code}', [ShortlinkController::class, 'redirect'])
        ->middleware('guest');



    
    /* ROUTE ACCESSIBLE ONLY WITH A TOKEN */
    Route::middleware(['auth:sanctum'])->group(function () {
    
        //display all the activated user module
        Route::get('modules', [ModuleController::class, 'show']);
        /* activation/deactivation of modules for a user */
        Route::post('modules/{id}/activate', [ModuleController::class, 'activate']);
        Route::post('modules/{id}/deactivate', [ModuleController::class, 'deactivate']);

    
        /* ROUTE ACCESSIBLE ONLY IF THE DESIRED MODULE IS ACTIVATED */

        //URL SHORTENER MODULE
        Route::middleware(CheckModuleActive::class . ':urlModule')->group(function () {

            Route::post('shorten', [ShortlinkController::class, 'shorten']);
            Route::get('links', [ShortlinkController::class, 'getLinks']);
            Route::delete('links/{id}', [ShortlinkController::class, "delete"]);
        });

        //WALLET MODULE
        Route::middleware(CheckModuleActive::class . ':walletModule')->group(function () {

            Route::get('wallet', [WalletController::class, 'showWallet']);

        });
    });
});

