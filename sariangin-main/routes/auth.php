<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'auth',
        'as' => 'auth.'
    ],
    function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->middleware('guest')
            ->name('login-page');

        Route::post('login', [AuthenticatedSessionController::class, 'store'])
            ->middleware('guest')
            ->name('login');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');
    }
);
