<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
Route::get('/test', [\App\Http\Controllers\Home\HomeController::class, 'test'])->name('test');


Route::post('uploadS3File', [\App\Http\Controllers\Home\HomeController::class, 'test'])->name('uploadS3File');
