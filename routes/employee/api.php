<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\Employee\EmployeeController::class, 'login'])->name('employee.api.login');
});

Route::middleware([
    'auth:employee_api'
])->group(function () {

    Route::post('swapTheme', [\App\Http\Controllers\Api\Employee\EmployeeController::class, 'swapTheme'])->name('employee.api.swapTheme');

    Route::prefix('shift')->group(function () {
        Route::get('getDateBetweenByEmployeeId', [\App\Http\Controllers\Api\Employee\ShiftController::class, 'getDateBetweenByEmployeeId'])->name('employee.api.shift.getDateBetweenByEmployeeId');
    });

    Route::prefix('permit')->group(function () {
        Route::get('getDateBetween', [\App\Http\Controllers\Api\Employee\PermitController::class, 'getDateBetween'])->name('employee.api.permit.getDateBetween');
        Route::post('create', [\App\Http\Controllers\Api\Employee\PermitController::class, 'create'])->name('employee.api.permit.create');
    });

    Route::prefix('overtime')->group(function () {
        Route::get('getDateBetween', [\App\Http\Controllers\Api\Employee\OvertimeController::class, 'getDateBetween'])->name('employee.api.overtime.getDateBetween');
        Route::post('create', [\App\Http\Controllers\Api\Employee\OvertimeController::class, 'create'])->name('employee.api.overtime.create');
    });

    Route::prefix('payment')->group(function () {
        Route::get('getDateBetween', [\App\Http\Controllers\Api\Employee\PaymentController::class, 'getDateBetween'])->name('employee.api.payment.getDateBetween');
        Route::post('create', [\App\Http\Controllers\Api\Employee\PaymentController::class, 'create'])->name('employee.api.payment.create');
    });

    Route::prefix('permitType')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\Employee\PermitTypeController::class, 'getAll'])->name('employee.api.permitType.getAll');
    });

    Route::prefix('overtimeType')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\Employee\OvertimeTypeController::class, 'getAll'])->name('employee.api.overtimeType.getAll');
    });

    Route::prefix('paymentType')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\Employee\PaymentTypeController::class, 'getAll'])->name('employee.api.paymentType.getAll');
    });

});
