<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::get('login', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'login'])->name('user.web.authentication.login.index');
    Route::get('oAuth', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'oAuth'])->name('user.web.authentication.oAuth');
    Route::get('forgotPassword', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'forgotPassword'])->name('user.web.authentication.forgotPassword');
    Route::get('resetPassword/{token?}', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'resetPassword'])->name('user.web.authentication.resetPassword');
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

        Route::prefix('dataScanning')->group(function () {
            Route::get('index', [\App\Http\Controllers\Web\User\Reports\DataScanningReportController::class, 'index'])->name('user.web.report.dataScanning.index');
        });

        Route::prefix('special')->group(function () {
            Route::get('index', [\App\Http\Controllers\Web\User\Reports\SpecialReportController::class, 'index'])->name('user.web.report.special.index');
        });

        Route::prefix('job')->group(function () {
            Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReportController::class, 'index'])->name('user.web.report.job.index');

            Route::prefix('callFind')->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReports\CallFindReportController::class, 'index'])->name('user.web.report.job.callFind.index');
            });

            Route::prefix('callFindDetail')->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReports\CallFindDetailReportController::class, 'index'])->name('user.web.report.job.callFindDetail.index');
            });

            Route::prefix('appointment')->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReports\AppointmentReportController::class, 'index'])->name('user.web.report.job.appointment.index');
            });

            Route::prefix('leavedEmployeeWorkStatus')->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReports\LeavedEmployeeWorkStatusReportController::class, 'index'])->name('user.web.report.job.leavedEmployeeWorkStatus.index');
            });
        });

        Route::prefix('employee')->group(function () {
            Route::get('index', [\App\Http\Controllers\Web\User\Reports\EmployeeReportController::class, 'index'])->name('user.web.report.employee.index');

            Route::prefix('jobDepartment')->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\EmployeeReports\JobDepartmentReportController::class, 'index'])->name('user.web.report.employee.jobDepartment.index');
            });
        });
    });

    Route::prefix('otsJob')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\OtsJobController::class, 'index'])->name('user.web.otsJob.index');
    });

    Route::prefix('santralMonitoring')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SantralMonitoringController::class, 'index'])->name('user.web.santralMonitoring.index');

        Route::prefix('monitor')->group(function () {
            Route::get('job', [\App\Http\Controllers\Web\User\SantralMonitoring\MonitorController::class, 'job'])->name('user.web.santralMonitoring.monitor.job');
            Route::get('employee', [\App\Http\Controllers\Web\User\SantralMonitoring\MonitorController::class, 'employee'])->name('user.web.santralMonitoring.monitor.employee');
            Route::get('achievement', [\App\Http\Controllers\Web\User\SantralMonitoring\MonitorController::class, 'achievement'])->name('user.web.santralMonitoring.monitor.achievement');
        });
    });

    Route::prefix('salesAndMarketing')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SalesAndMarketingController::class, 'index'])->name('user.web.salesAndMarketing.index');

        Route::prefix('modules')->group(function () {
            Route::prefix('survey')->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyController::class, 'index'])->name('user.web.salesAndMarketing.modules.survey.index');
                Route::get('question', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyController::class, 'question'])->name('user.web.salesAndMarketing.modules.survey.question');
                Route::get('examine', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyController::class, 'examine'])->name('user.web.salesAndMarketing.modules.survey.examine');

                Route::prefix('report')->group(function () {
                    Route::get('general', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyReportController::class, 'general'])->name('user.web.salesAndMarketing.modules.survey.report.general');
                    Route::get('detail', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyReportController::class, 'detail'])->name('user.web.salesAndMarketing.modules.survey.report.detail');
                    Route::get('employee', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyReportController::class, 'employee'])->name('user.web.salesAndMarketing.modules.survey.report.employee');
                });
            });
            Route::get('seller', [\App\Http\Controllers\Web\User\SalesAndMarketing\SellerController::class, 'index'])->name('user.web.salesAndMarketing.modules.seller.index');
            Route::get('product', [\App\Http\Controllers\Web\User\SalesAndMarketing\ProductController::class, 'index'])->name('user.web.salesAndMarketing.modules.product.index');
        });
    });

    Route::prefix('academy')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\AcademyController::class, 'index'])->name('user.web.academy.index');
        Route::get('education', [\App\Http\Controllers\Web\User\AcademyController::class, 'education'])->name('user.web.academy.education');
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

    Route::prefix('purchase')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\PurchaseController::class, 'index'])->name('user.web.purchase.index');
        Route::get('purchase', [\App\Http\Controllers\Web\User\PurchaseController::class, 'purchase'])->name('user.web.purchase.purchase');
        Route::get('report', [\App\Http\Controllers\Web\User\PurchaseController::class, 'report'])->name('user.web.purchase.report');
    });

    Route::prefix('market')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\MarketController::class, 'index'])->name('user.web.market.index');
        Route::get('employee', [\App\Http\Controllers\Web\User\MarketController::class, 'employee'])->name('user.web.market.employee');
        Route::get('market', [\App\Http\Controllers\Web\User\MarketController::class, 'market'])->name('user.web.market.market');
    });

    Route::prefix('humanResources')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\HumanResourcesController::class, 'index'])->name('user.web.humanResources.index');
        Route::get('dashboard', [\App\Http\Controllers\Web\User\HumanResourcesController::class, 'dashboard'])->name('user.web.humanResources.dashboard');
        Route::get('calendar', [\App\Http\Controllers\Web\User\HumanResourcesController::class, 'calendar'])->name('user.web.humanResources.calendar');
        Route::get('permit', [\App\Http\Controllers\Web\User\HumanResourcesController::class, 'permit'])->name('user.web.humanResources.permit');
        Route::get('overtime', [\App\Http\Controllers\Web\User\HumanResourcesController::class, 'overtime'])->name('user.web.humanResources.overtime');
        Route::get('payment', [\App\Http\Controllers\Web\User\HumanResourcesController::class, 'payment'])->name('user.web.humanResources.payment');
        Route::get('report', [\App\Http\Controllers\Web\User\HumanResourcesController::class, 'report'])->name('user.web.humanResources.report');

        Route::prefix('report')->group(function () {
            Route::get('ageAndGender', [\App\Http\Controllers\Web\User\HumanResources\ReportController::class, 'ageAndGender'])->name('user.web.humanResources.report.ageAndGender');
            Route::get('education', [\App\Http\Controllers\Web\User\HumanResources\ReportController::class, 'education'])->name('user.web.humanResources.report.education');
            Route::get('bloodGroup', [\App\Http\Controllers\Web\User\HumanResources\ReportController::class, 'bloodGroup'])->name('user.web.humanResources.report.bloodGroup');
            Route::get('permit', [\App\Http\Controllers\Web\User\HumanResources\ReportController::class, 'permit'])->name('user.web.humanResources.report.permit');
            Route::get('overtime', [\App\Http\Controllers\Web\User\HumanResources\ReportController::class, 'overtime'])->name('user.web.humanResources.report.overtime');
            Route::get('payment', [\App\Http\Controllers\Web\User\HumanResources\ReportController::class, 'payment'])->name('user.web.humanResources.report.payment');
        });

        Route::prefix('employee')->group(function () {
            Route::get('index', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'index'])->name('user.web.humanResources.employee.index');
            Route::get('personalInformation/{id?}', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'personalInformation'])->name('user.web.humanResources.employee.personalInformation');
            Route::get('position/{id?}', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'position'])->name('user.web.humanResources.employee.position');
            Route::get('permit/{id?}', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'permit'])->name('user.web.humanResources.employee.permit');
            Route::get('overtime/{id?}', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'overtime'])->name('user.web.humanResources.employee.overtime');
            Route::get('payment/{id?}', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'payment'])->name('user.web.humanResources.employee.payment');
            Route::get('device/{id?}', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'device'])->name('user.web.humanResources.employee.device');
            Route::get('file/{id?}', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'file'])->name('user.web.humanResources.employee.file');
            Route::get('shift/{id?}', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'shift'])->name('user.web.humanResources.employee.shift');
            Route::get('punishment/{id?}', [\App\Http\Controllers\Web\User\HumanResources\EmployeeController::class, 'punishment'])->name('user.web.humanResources.employee.punishment');
        });
    });

    Route::prefix('recruiting')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\RecruitingController::class, 'index'])->name('user.web.recruiting.index');
    });

    Route::prefix('project')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ProjectController::class, 'index'])->name('user.web.project.index');
        Route::get('overview/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'overview'])->name('user.web.project.overview');
        Route::get('task/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'task'])->name('user.web.project.task');
        Route::get('managementTask/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'managementTask'])->name('user.web.project.managementTask');
        Route::get('note/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'note'])->name('user.web.project.note');
        Route::get('file/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'file'])->name('user.web.project.file');
        Route::get('ticket/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'ticket'])->name('user.web.project.ticket');
    });

    Route::prefix('inventory')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\InventoryController::class, 'index'])->name('user.web.inventory.index');
        Route::get('employee', [\App\Http\Controllers\Web\User\InventoryController::class, 'employee'])->name('user.web.inventory.employee');
        Route::get('device', [\App\Http\Controllers\Web\User\InventoryController::class, 'device'])->name('user.web.inventory.device');
        Route::get('package', [\App\Http\Controllers\Web\User\InventoryController::class, 'package'])->name('user.web.inventory.package');
    });

    Route::prefix('assignment')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\AssignmentController::class, 'index'])->name('user.web.assignment.index');
    });

    Route::prefix('centralMission')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\CentralMissionController::class, 'index'])->name('user.web.centralMission.index');
    });

    Route::prefix('ticket')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\TicketController::class, 'index'])->name('user.web.ticket.index');
    });

    Route::prefix('screenMonitoring')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ScreenMonitoringController::class, 'index'])->name('user.web.screenMonitoring.index');
    });

    Route::prefix('shiftGroup')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ShiftGroupController::class, 'index'])->name('user.web.shiftGroup.index');
    });

    Route::prefix('user')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\UserController::class, 'index'])->name('user.web.user.index');
    });

    Route::prefix('company')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\CompanyController::class, 'index'])->name('user.web.company.index');
    });

    Route::prefix('queue')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\QueueController::class, 'index'])->name('user.web.queue.index');
    });

    Route::prefix('competence')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\CompetenceController::class, 'index'])->name('user.web.competence.index');
    });

    Route::prefix('jobDepartment')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\JobDepartmentController::class, 'index'])->name('user.web.jobDepartment.index');
    });

    Route::prefix('jobDepartmentType')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\JobDepartmentTypeController::class, 'index'])->name('user.web.jobDepartmentType.index');
    });

    Route::prefix('userRole')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\UserRoleController::class, 'index'])->name('user.web.userRole.index');
    });

    Route::prefix('file')->group(function () {
        Route::get('download/{id?}', [\App\Http\Controllers\Web\User\FileController::class, 'download'])->name('user.web.file.download');
    });
});
