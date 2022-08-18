<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\Employee\EmployeeController::class, 'login'])->name('employee.api.login');
});

Route::middleware([
    'auth:employee_api'
])->group(function () {

    Route::get('getProfile', [\App\Http\Controllers\Api\Employee\EmployeeController::class, 'getProfile'])->name('employee.api.getProfile');
    Route::post('swapTheme', [\App\Http\Controllers\Api\Employee\EmployeeController::class, 'swapTheme'])->name('employee.api.swapTheme');
    Route::post('setDeviceToken', [\App\Http\Controllers\Api\Employee\EmployeeController::class, 'setDeviceToken'])->name('employee.api.setDeviceToken');
    Route::get('getMarketPayments', [\App\Http\Controllers\Api\Employee\EmployeeController::class, 'getMarketPayments'])->name('employee.api.getMarketPayments');
    Route::get('getPositions', [\App\Http\Controllers\Api\Employee\EmployeeController::class, 'getPositions'])->name('employee.api.getPositions');

    Route::prefix('employeePersonalInformation')->group(function () {
        Route::get('getByEmployeeId', [\App\Http\Controllers\Api\Employee\EmployeePersonalInformationController::class, 'getByEmployeeId'])->name('employee.api.employeePersonalInformation.getByEmployeeId');
        Route::put('update', [\App\Http\Controllers\Api\Employee\EmployeePersonalInformationController::class, 'update'])->name('employee.api.employeePersonalInformation.update');
    });

    Route::prefix('shift')->group(function () {
        Route::get('getDateBetweenByEmployeeId', [\App\Http\Controllers\Api\Employee\ShiftController::class, 'getDateBetweenByEmployeeId'])->name('employee.api.shift.getDateBetweenByEmployeeId');
        Route::get('getByDateAndEmployeeId', [\App\Http\Controllers\Api\Employee\ShiftController::class, 'getByDateAndEmployeeId'])->name('employee.api.shift.getByDateAndEmployeeId');
        Route::get('getById', [\App\Http\Controllers\Api\Employee\ShiftController::class, 'getById'])->name('employee.api.shift.getById');
    });

    Route::prefix('permit')->group(function () {
        Route::get('getDateBetween', [\App\Http\Controllers\Api\Employee\PermitController::class, 'getDateBetween'])->name('employee.api.permit.getDateBetween');
        Route::get('getById', [\App\Http\Controllers\Api\Employee\PermitController::class, 'getById'])->name('employee.api.permit.getById');
        Route::post('create', [\App\Http\Controllers\Api\Employee\PermitController::class, 'create'])->name('employee.api.permit.create');
        Route::put('update', [\App\Http\Controllers\Api\Employee\PermitController::class, 'update'])->name('employee.api.permit.update');
    });

    Route::prefix('overtime')->group(function () {
        Route::get('getDateBetween', [\App\Http\Controllers\Api\Employee\OvertimeController::class, 'getDateBetween'])->name('employee.api.overtime.getDateBetween');
        Route::get('getById', [\App\Http\Controllers\Api\Employee\OvertimeController::class, 'getById'])->name('employee.api.overtime.getById');
        Route::post('create', [\App\Http\Controllers\Api\Employee\OvertimeController::class, 'create'])->name('employee.api.overtime.create');
        Route::put('update', [\App\Http\Controllers\Api\Employee\OvertimeController::class, 'update'])->name('employee.api.overtime.update');
    });

    Route::prefix('payment')->group(function () {
        Route::get('getDateBetween', [\App\Http\Controllers\Api\Employee\PaymentController::class, 'getDateBetween'])->name('employee.api.payment.getDateBetween');
        Route::get('getById', [\App\Http\Controllers\Api\Employee\PaymentController::class, 'getById'])->name('employee.api.payment.getById');
        Route::post('create', [\App\Http\Controllers\Api\Employee\PaymentController::class, 'create'])->name('employee.api.payment.create');
        Route::put('update', [\App\Http\Controllers\Api\Employee\PaymentController::class, 'update'])->name('employee.api.payment.update');
    });

    Route::prefix('employeeSuggestion')->group(function () {
        Route::get('getByEmployeeId', [\App\Http\Controllers\Api\Employee\EmployeeSuggestionController::class, 'getByEmployeeId'])->name('employee.api.employeeSuggestion.getByEmployeeId');
        Route::get('getById', [\App\Http\Controllers\Api\Employee\EmployeeSuggestionController::class, 'getById'])->name('employee.api.employeeSuggestion.getById');
        Route::post('create', [\App\Http\Controllers\Api\Employee\EmployeeSuggestionController::class, 'create'])->name('employee.api.employeeSuggestion.create');
        Route::put('update', [\App\Http\Controllers\Api\Employee\EmployeeSuggestionController::class, 'update'])->name('employee.api.employeeSuggestion.update');
        Route::delete('delete', [\App\Http\Controllers\Api\Employee\EmployeeSuggestionController::class, 'delete'])->name('employee.api.employeeSuggestion.delete');
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

    Route::prefix('foodList')->group(function () {
        Route::get('getDateBetween', [\App\Http\Controllers\Api\Employee\FoodListController::class, 'getDateBetween'])->name('employee.api.foodList.getDateBetween');
    });

    Route::prefix('foodListCheck')->group(function () {
        Route::get('getDateBetween', [\App\Http\Controllers\Api\Employee\FoodListCheckController::class, 'getDateBetween'])->name('employee.api.foodListCheck.getDateBetween');
        Route::get('getById', [\App\Http\Controllers\Api\Employee\FoodListCheckController::class, 'getById'])->name('employee.api.foodListCheck.getById');
        Route::put('update', [\App\Http\Controllers\Api\Employee\FoodListCheckController::class, 'update'])->name('employee.api.foodListCheck.update');
    });

    Route::prefix('marketPayment')->group(function () {
        Route::post('create', [\App\Http\Controllers\Api\Employee\MarketPaymentController::class, 'create'])->name('employee.api.marketPayment.create');
    });

    Route::prefix('operationApi')->group(function () {

        Route::prefix('personReport')->group(function () {
            Route::get('getPersonPenalties', [\App\Http\Controllers\Api\Employee\OperationApi\PersonReportController::class, 'getPersonPenalties'])->name('employee.api.operationApi.personReport.getPersonPenalties');
            Route::get('getAchievementPointsSingleDetails', [\App\Http\Controllers\Api\Employee\OperationApi\PersonReportController::class, 'getAchievementPointsSingleDetails'])->name('employee.api.operationApi.personReport.getAchievementPointsSingleDetails');
            Route::get('getPersonPenaltiesDetails', [\App\Http\Controllers\Api\Employee\OperationApi\PersonReportController::class, 'getPersonPenaltiesDetails'])->name('employee.api.operationApi.personReport.getPersonPenaltiesDetails');
            Route::get('getPersonnelAchievementRanking', [\App\Http\Controllers\Api\Employee\OperationApi\PersonReportController::class, 'getPersonnelAchievementRanking'])->name('employee.api.operationApi.personReport.getPersonnelAchievementRanking');
        });

    });
});
