<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
Route::get('/test', function () {
    return \App\Models\Eloquent\UserPermission::where('top_id', null)->get();
})->name('test');
Route::get('/test2', [\App\Http\Controllers\Home\HomeController::class, 'test2'])->name('test2');
Route::get('/test3', [\App\Http\Controllers\Home\HomeController::class, 'test3'])->name('test3');

