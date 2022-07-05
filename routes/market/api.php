<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\Market\MarketController::class, 'login'])->name('market.api.login');
});

Route::middleware([
    'auth:market_api'
])->group(function () {

    Route::post('swapTheme', [\App\Http\Controllers\Api\Market\MarketController::class, 'swapTheme'])->name('market.api.swapTheme');

    Route::prefix('marketPayment')->group(function () {
        Route::post('getByCode', [\App\Http\Controllers\Api\Market\MarketPaymentController::class, 'getByCode'])->name('market.api.marketPayment.getByCode');
        Route::post('setCompleted', [\App\Http\Controllers\Api\Market\MarketPaymentController::class, 'setCompleted'])->name('market.api.marketPayment.setCompleted');
    });

});
