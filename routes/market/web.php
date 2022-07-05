<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::get('login', [\App\Http\Controllers\Web\Market\AuthenticationController::class, 'login'])->name('market.web.authentication.login.index');
    Route::get('oAuth', [\App\Http\Controllers\Web\Market\AuthenticationController::class, 'oAuth'])->name('market.web.authentication.oAuth');
    Route::get('forgotPassword', [\App\Http\Controllers\Web\Market\AuthenticationController::class, 'forgotPassword'])->name('market.web.authentication.forgotPassword');
    Route::get('resetPassword/{token?}', [\App\Http\Controllers\Web\Market\AuthenticationController::class, 'resetPassword'])->name('market.web.authentication.resetPassword');
});

Route::middleware([
    'auth:market_web'
])->group(function () {

    Route::get('logout', [\App\Http\Controllers\Web\Market\AuthenticationController::class, 'logout'])->name('market.web.authentication.logout');

    Route::prefix('dashboard')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Market\DashboardController::class, 'index'])->name('market.web.dashboard.index');
    });

});
