<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::get('login', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'login'])->name('user.web.authentication.login.index');
    Route::get('oAuth', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'oAuth'])->name('user.web.authentication.oAuth');
});

Route::middleware([
    'auth:user_web'
])->group(function () {

    Route::get('logout', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'logout'])->name('user.web.authentication.logout');

    Route::prefix('dashboard')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\DashboardController::class, 'index'])->name('user.web.dashboard.index');
    });

    Route::prefix('employee')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\EmployeeController::class, 'index'])->name('user.web.employee.index');
    });

    Route::prefix('report')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ReportController::class, 'index'])->name('user.web.report.index');
    });

    Route::prefix('otsJob')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\OtsJobController::class, 'index'])->name('user.web.otsJob.index');
    });

    Route::prefix('santralMonitoring')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SantralMonitoringController::class, 'index'])->name('user.web.santralMonitoring.index');
    });

    Route::prefix('salesAndMarketing')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SalesAndMarketingController::class, 'index'])->name('user.web.salesAndMarketing.index');
    });

    Route::prefix('academy')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\AcademyController::class, 'index'])->name('user.web.academy.index');
    });

    Route::prefix('shift')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ShiftController::class, 'index'])->name('user.web.shift.index');
    });

    Route::prefix('saturdayPermit')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SaturdayPermitController::class, 'index'])->name('user.web.saturdayPermit.index');
    });

    Route::prefix('specialReport')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SpecialReportController::class, 'index'])->name('user.web.specialReport.index');
    });

    Route::prefix('meeting')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\MeetingController::class, 'index'])->name('user.web.meeting.index');
    });

    Route::prefix('performance')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\PerformanceController::class, 'index'])->name('user.web.performance.index');
    });

    Route::prefix('qualityAssessment')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\QualityAssessmentController::class, 'index'])->name('user.web.qualityAssessment.index');
    });

    Route::prefix('closingJob')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ClosingJobController::class, 'index'])->name('user.web.closingJob.index');
    });

    Route::prefix('market')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\MarketController::class, 'index'])->name('user.web.market.index');
    });

    Route::prefix('humanResources')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\HumanResourcesController::class, 'index'])->name('user.web.humanResources.index');
    });

    Route::prefix('recruiting')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\RecruitingController::class, 'index'])->name('user.web.recruiting.index');
    });

    Route::prefix('project')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ProjectController::class, 'index'])->name('user.web.project.index');
    });

    Route::prefix('inventory')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\InventoryController::class, 'index'])->name('user.web.inventory.index');
    });

    Route::prefix('assignment')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\AssignmentController::class, 'index'])->name('user.web.assignment.index');
    });

    Route::prefix('ticket')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\TicketController::class, 'index'])->name('user.web.ticket.index');
    });

    Route::prefix('screenMonitoring')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ScreenMonitoringController::class, 'index'])->name('user.web.screenMonitoring.index');
    });

});
