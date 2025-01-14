<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::get('login', [\App\Http\Controllers\Web\Employee\AuthenticationController::class, 'login'])->name('employee.web.authentication.login.index');
    Route::get('oAuth', [\App\Http\Controllers\Web\Employee\AuthenticationController::class, 'oAuth'])->name('employee.web.authentication.oAuth');
    Route::get('forgotPassword', [\App\Http\Controllers\Web\Employee\AuthenticationController::class, 'forgotPassword'])->name('employee.web.authentication.forgotPassword');
    Route::get('resetPassword/{token?}', [\App\Http\Controllers\Web\Employee\AuthenticationController::class, 'resetPassword'])->name('employee.web.authentication.resetPassword');
});

Route::middleware([
    'auth:employee_web'
])->group(function () {

    Route::get('logout', [\App\Http\Controllers\Web\Employee\AuthenticationController::class, 'logout'])->name('employee.web.authentication.logout');

    Route::prefix('dashboard')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Employee\DashboardController::class, 'index'])->name('employee.web.dashboard.index');
    });

    Route::prefix('profile')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Employee\ProfileController::class, 'index'])->name('employee.web.profile.index');
    });

    Route::prefix('employee')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Employee\EmployeeController::class, 'index'])->name('employee.web.employee.index');
    });

    Route::prefix('performance')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Employee\PerformanceController::class, 'index'])->name('employee.web.performance.index');
        Route::get('status', [\App\Http\Controllers\Web\Employee\PerformanceController::class, 'status'])->name('employee.web.performance.status');
        Route::get('achievement', [\App\Http\Controllers\Web\Employee\PerformanceController::class, 'achievement'])->name('employee.web.performance.achievement');
    });

    Route::prefix('employeeSuggestion')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Employee\EmployeeSuggestionController::class, 'index'])->name('employee.web.employeeSuggestion.index');
    });

    Route::prefix('abandon')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Employee\AbandonController::class, 'index'])->name('employee.web.abandon.index');
    });

    Route::prefix('knowledgeBase')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Employee\KnowledgeBaseController::class, 'index'])->name('employee.web.knowledgeBase.index');
        Route::get('question/{id?}', [\App\Http\Controllers\Web\Employee\KnowledgeBaseController::class, 'question'])->name('employee.web.knowledgeBase.question');
    });

    Route::prefix('earthquakeInformation')->group(function () {
//        Route::get('index', [\App\Http\Controllers\Web\Employee\EarthquakeInformationController::class, 'index'])->name('employee.web.specialInformation.index');
    });

    Route::prefix('specialInformation')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Employee\SpecialInformationController::class, 'index'])->name('employee.web.specialInformation.index');
    });

    Route::prefix('socialEvent')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Employee\SocialEventController::class, 'index'])->name('employee.web.socialEvent.index');
    });
});
