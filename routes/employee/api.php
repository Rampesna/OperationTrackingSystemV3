<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\Employee\EmployeeController::class, 'login'])->name('employee.api.login');
});

Route::middleware([
    'auth:employee_api'
])->group(function () {

});
