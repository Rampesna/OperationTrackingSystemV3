<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
Route::get('/test', [\App\Http\Controllers\Home\HomeController::class, 'test'])->name('test');
