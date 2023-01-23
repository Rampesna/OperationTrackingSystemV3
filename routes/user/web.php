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

    Route::prefix('profile')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ProfileController::class, 'index'])->name('user.web.profile.index');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\DashboardController::class, 'index'])->name('user.web.dashboard.index');
    });

    Route::prefix('employee')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\EmployeeController::class, 'index'])->name('user.web.employee.index')->middleware('CheckUserPermission:1');
    });

    Route::prefix('report')->middleware([
        'CheckUserPermission:2'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ReportController::class, 'index'])->name('user.web.report.index');

        Route::prefix('dataScanning')->middleware(['CheckUserPermission:26'])->group(function () {
            Route::get('index', [\App\Http\Controllers\Web\User\Reports\DataScanningReportController::class, 'index'])->name('user.web.report.dataScanning.index');
        });

        Route::prefix('special')->middleware(['CheckUserPermission:27'])->group(function () {
            Route::get('index', [\App\Http\Controllers\Web\User\Reports\SpecialReportController::class, 'index'])->name('user.web.report.special.index');
        });

        Route::prefix('job')->middleware(['CheckUserPermission:28'])->group(function () {
            Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReportController::class, 'index'])->name('user.web.report.job.index');

            Route::prefix('callFind')->middleware(['CheckUserPermission:32'])->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReports\CallFindReportController::class, 'index'])->name('user.web.report.job.callFind.index');
            });

            Route::prefix('callFindDetail')->middleware(['CheckUserPermission:33'])->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReports\CallFindDetailReportController::class, 'index'])->name('user.web.report.job.callFindDetail.index');
            });

            Route::prefix('appointment')->middleware(['CheckUserPermission:34'])->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReports\AppointmentReportController::class, 'index'])->name('user.web.report.job.appointment.index');
            });

            Route::prefix('leavedEmployeeWorkStatus')->middleware(['CheckUserPermission:35'])->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReports\LeavedEmployeeWorkStatusReportController::class, 'index'])->name('user.web.report.job.leavedEmployeeWorkStatus.index');
            });

            Route::prefix('gibCallFind')->middleware(['CheckUserPermission:203'])->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\JobReports\GibCallFindReportController::class, 'index'])->name('user.web.report.job.gibCallFind.index');
            });
        });

        Route::prefix('employee')->middleware(['CheckUserPermission:29'])->group(function () {
            Route::get('index', [\App\Http\Controllers\Web\User\Reports\EmployeeReportController::class, 'index'])->name('user.web.report.employee.index');

            Route::prefix('jobDepartment')->middleware(['CheckUserPermission:36'])->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\EmployeeReports\JobDepartmentReportController::class, 'index'])->name('user.web.report.employee.jobDepartment.index');
            });

            Route::prefix('overtimeStartEnd')->middleware(['CheckUserPermission:204'])->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\EmployeeReports\OvertimeStartEndReportController::class, 'index'])->name('user.web.report.employee.overtimeStartEnd.index');
            });

            Route::prefix('break')->middleware(['CheckUserPermission:205'])->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\EmployeeReports\BreakReportController::class, 'index'])->name('user.web.report.employee.break.index');
            });

            Route::prefix('monthlyAbsence')->middleware(['CheckUserPermission:206'])->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\Reports\EmployeeReports\MonthlyAbsenceReportController::class, 'index'])->name('user.web.report.employee.monthlyAbsence.index');
            });
        });
    });

    Route::prefix('otsJob')->middleware([
        'CheckUserPermission:3'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\OtsJobController::class, 'index'])->name('user.web.otsJob.index');
    });

    Route::prefix('santralMonitoring')->middleware([
        'CheckUserPermission:4'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SantralMonitoringController::class, 'index'])->name('user.web.santralMonitoring.index');
        Route::get('abandon', [\App\Http\Controllers\Web\User\SantralMonitoringController::class, 'abandon'])->name('user.web.santralMonitoring.abandon');

        Route::prefix('monitor')->group(function () {
            Route::get('job', [\App\Http\Controllers\Web\User\SantralMonitoring\MonitorController::class, 'job'])->name('user.web.santralMonitoring.monitor.job');
            Route::get('employee', [\App\Http\Controllers\Web\User\SantralMonitoring\MonitorController::class, 'employee'])->name('user.web.santralMonitoring.monitor.employee');
            Route::get('achievement', [\App\Http\Controllers\Web\User\SantralMonitoring\MonitorController::class, 'achievement'])->name('user.web.santralMonitoring.monitor.achievement');
        });
    });

    Route::prefix('salesAndMarketing')->middleware([
        'CheckUserPermission:5'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SalesAndMarketingController::class, 'index'])->name('user.web.salesAndMarketing.index');

        Route::prefix('modules')->group(function () {
            Route::prefix('survey')->group(function () {
                Route::get('index', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyController::class, 'index'])->name('user.web.salesAndMarketing.modules.survey.index');
                Route::get('create', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyController::class, 'create'])->name('user.web.salesAndMarketing.modules.survey.create');
                Route::get('update/{scriptId?}/{scriptCode?}', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyController::class, 'update'])->name('user.web.salesAndMarketing.modules.survey.update');
                Route::get('question', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyController::class, 'question'])->name('user.web.salesAndMarketing.modules.survey.question');
                Route::get('examine', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyController::class, 'examine'])->name('user.web.salesAndMarketing.modules.survey.examine');

                Route::prefix('report')->group(function () {
                    Route::get('general', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyReportController::class, 'general'])->name('user.web.salesAndMarketing.modules.survey.report.general');
                    Route::get('detail', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyReportController::class, 'detail'])->name('user.web.salesAndMarketing.modules.survey.report.detail');
                    Route::get('employee', [\App\Http\Controllers\Web\User\SalesAndMarketing\SurveyReportController::class, 'employee'])->name('user.web.salesAndMarketing.modules.survey.report.employee');
                });
            });
            Route::get('seller', [\App\Http\Controllers\Web\User\SalesAndMarketing\SellerController::class, 'index'])->name('user.web.salesAndMarketing.modules.seller.index');
            Route::get('batchSeller', [\App\Http\Controllers\Web\User\SalesAndMarketing\SellerController::class, 'batchSeller'])->name('user.web.salesAndMarketing.modules.batchSeller.index');
            Route::get('product', [\App\Http\Controllers\Web\User\SalesAndMarketing\ProductController::class, 'index'])->name('user.web.salesAndMarketing.modules.product.index');
            Route::get('category', [\App\Http\Controllers\Web\User\SalesAndMarketing\CategoryController::class, 'index'])->name('user.web.salesAndMarketing.modules.category.index');
            Route::get('opponent', [\App\Http\Controllers\Web\User\SalesAndMarketing\OpponentController::class, 'index'])->name('user.web.salesAndMarketing.modules.opponent.index');
            Route::get('software', [\App\Http\Controllers\Web\User\SalesAndMarketing\SoftwareController::class, 'index'])->name('user.web.salesAndMarketing.modules.software.index');
            Route::get('integrator', [\App\Http\Controllers\Web\User\SalesAndMarketing\IntegratorController::class, 'index'])->name('user.web.salesAndMarketing.modules.integrator.index');
        });
    });

    Route::prefix('academy')->middleware([
        'CheckUserPermission:6'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\AcademyController::class, 'index'])->name('user.web.academy.index');
        Route::get('education', [\App\Http\Controllers\Web\User\AcademyController::class, 'education'])->name('user.web.academy.education');
    });

    Route::prefix('shift')->middleware([
        'CheckUserPermission:7'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ShiftController::class, 'index'])->name('user.web.shift.index');
    });

    Route::prefix('saturdayPermit')->middleware([
        'CheckUserPermission:8'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SaturdayPermitController::class, 'index'])->name('user.web.saturdayPermit.index');
    });

    Route::prefix('specialReport')->middleware([
        'CheckUserPermission:9'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SpecialReportController::class, 'index'])->name('user.web.specialReport.index');
    });

    Route::prefix('meeting')->middleware([
        'CheckUserPermission:10'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\MeetingController::class, 'index'])->name('user.web.meeting.index');
        Route::get('meetingAgenda', [\App\Http\Controllers\Web\User\MeetingController::class, 'meetingAgenda'])->name('user.web.meeting.meetingAgenda');
        Route::get('agenda/{meetingId?}', [\App\Http\Controllers\Web\User\MeetingController::class, 'agenda'])->name('user.web.meeting.agenda');
    });

    Route::prefix('performance')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\PerformanceController::class, 'index'])->name('user.web.performance.index');
        Route::get('prCard', [\App\Http\Controllers\Web\User\PerformanceController::class, 'prCard'])->name('user.web.performance.prCard');
        Route::get('prCritter', [\App\Http\Controllers\Web\User\PerformanceController::class, 'prCritter'])->name('user.web.performance.prCritter');
        Route::get('prResult', [\App\Http\Controllers\Web\User\PerformanceController::class, 'prResult'])->name('user.web.performance.prResult');
    });

    Route::prefix('qualityAssessment')->middleware([
        'CheckUserPermission:181'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\QualityAssessmentController::class, 'index'])->name('user.web.qualityAssessment.index');
        Route::get('call', [\App\Http\Controllers\Web\User\QualityAssessmentController::class, 'call'])->name('user.web.qualityAssessment.call');
        Route::get('mail', [\App\Http\Controllers\Web\User\QualityAssessmentController::class, 'mail'])->name('user.web.qualityAssessment.mail');
    });

    Route::prefix('closingJob')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ClosingJobController::class, 'index'])->name('user.web.closingJob.index');
    });

    Route::prefix('market')->middleware([
        'CheckUserPermission:11'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\MarketController::class, 'index'])->name('user.web.market.index');
        Route::get('employee', [\App\Http\Controllers\Web\User\MarketController::class, 'employee'])->name('user.web.market.employee');
        Route::get('market', [\App\Http\Controllers\Web\User\MarketController::class, 'market'])->name('user.web.market.market');
    });

    Route::prefix('purchase')->middleware([
        'CheckUserPermission:12'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\PurchaseController::class, 'index'])->name('user.web.purchase.index');
        Route::get('purchase', [\App\Http\Controllers\Web\User\PurchaseController::class, 'purchase'])->name('user.web.purchase.purchase');
        Route::get('report', [\App\Http\Controllers\Web\User\PurchaseController::class, 'report'])->name('user.web.purchase.report');
    });

    Route::prefix('humanResources')->middleware([
        'CheckUserPermission:13'
    ])->group(function () {
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
            Route::get('annualPermit', [\App\Http\Controllers\Web\User\HumanResources\ReportController::class, 'annualPermit'])->name('user.web.humanResources.report.annualPermit');
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

    Route::prefix('foodList')->middleware([
        'CheckUserPermission:14'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\FoodListController::class, 'index'])->name('user.web.foodList.index');
        Route::get('foodList', [\App\Http\Controllers\Web\User\FoodListController::class, 'foodList'])->name('user.web.foodList.foodList');
        Route::get('report', [\App\Http\Controllers\Web\User\FoodListController::class, 'report'])->name('user.web.foodList.report');
    });

    Route::prefix('project')->middleware([
        'CheckUserPermission:15'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ProjectController::class, 'index'])->name('user.web.project.index');
        Route::get('timesheet', [\App\Http\Controllers\Web\User\ProjectController::class, 'timesheet'])->name('user.web.project.timesheet');
        Route::get('overview/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'overview'])->name('user.web.project.overview');
        Route::get('task/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'task'])->name('user.web.project.task');
        Route::get('managementTask/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'managementTask'])->name('user.web.project.managementTask');
        Route::get('note/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'note'])->name('user.web.project.note');
        Route::get('file/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'file'])->name('user.web.project.file');
        Route::get('ticket/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'ticket'])->name('user.web.project.ticket');
        Route::get('version/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'version'])->name('user.web.project.version');
        Route::get('projectJob/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'projectJob'])->name('user.web.project.projectJob');
        Route::get('landingCustomer/{id?}', [\App\Http\Controllers\Web\User\ProjectController::class, 'landingCustomer'])->name('user.web.project.landingCustomer');
    });

    Route::prefix('inventory')->middleware([
        'CheckUserPermission:16'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\InventoryController::class, 'index'])->name('user.web.inventory.index');
        Route::get('employee', [\App\Http\Controllers\Web\User\InventoryController::class, 'employee'])->name('user.web.inventory.employee');
        Route::get('device', [\App\Http\Controllers\Web\User\InventoryController::class, 'device'])->name('user.web.inventory.device');
        Route::get('package', [\App\Http\Controllers\Web\User\InventoryController::class, 'package'])->name('user.web.inventory.package');
    });

    Route::prefix('centralMission')->middleware([
        'CheckUserPermission:17'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\CentralMissionController::class, 'index'])->name('user.web.centralMission.index');
    });

    Route::prefix('ticket')->middleware([
        'CheckUserPermission:18'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\TicketController::class, 'index'])->name('user.web.ticket.index');
    });

    Route::prefix('career')->middleware([
        'CheckUserPermission:187'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\CareerController::class, 'index'])->name('user.web.career.index');
    });

    Route::prefix('batchSms')->middleware([
        'CheckUserPermission:190'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\BatchSmsController::class, 'index'])->name('user.web.batchSms.index');
    });

    Route::prefix('recruiting')->middleware([
        'CheckUserPermission:175'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\RecruitingController::class, 'index'])->name('user.web.recruiting.index');
        Route::get('recruiting', [\App\Http\Controllers\Web\User\RecruitingController::class, 'recruiting'])->name('user.web.recruiting.recruiting');
        Route::get('recruitingStep', [\App\Http\Controllers\Web\User\RecruitingController::class, 'recruitingStep'])->name('user.web.recruiting.recruitingStep');
        Route::get('evaluationParameter', [\App\Http\Controllers\Web\User\RecruitingController::class, 'evaluationParameter'])->name('user.web.recruiting.evaluationParameter');
        Route::get('wizard/{id?}', [\App\Http\Controllers\Web\User\RecruitingController::class, 'wizard'])->name('user.web.recruiting.wizard');

        Route::get('download', [\App\Http\Controllers\Web\User\RecruitingController::class, 'download'])->name('user.web.recruiting.download');
    });

    Route::prefix('assignment')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\AssignmentController::class, 'index'])->name('user.web.assignment.index');
    });

    Route::prefix('employeeSuggestion')->middleware([
        'CheckUserPermission:180'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\EmployeeSuggestionController::class, 'index'])->name('user.web.employeeSuggestion.index');
    });

    Route::prefix('screenMonitoring')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ScreenMonitoringController::class, 'index'])->name('user.web.screenMonitoring.index');
    });

    Route::prefix('exam')->middleware([
        'CheckUserPermission:197'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ExamController::class, 'index'])->name('user.web.exam.index');
        Route::get('employee/{examId?}', [\App\Http\Controllers\Web\User\ExamController::class, 'employee'])->name('user.web.exam.employee');
    });

    Route::prefix('settings')->middleware([
        'CheckUserPermission:166'
    ])->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SettingsController::class, 'index'])->name('user.web.settings.index');
        Route::get('company', [\App\Http\Controllers\Web\User\SettingsController::class, 'company'])->name('user.web.settings.company');
        Route::get('queue', [\App\Http\Controllers\Web\User\SettingsController::class, 'queue'])->name('user.web.settings.queue');
        Route::get('competence', [\App\Http\Controllers\Web\User\SettingsController::class, 'competence'])->name('user.web.settings.competence');
        Route::get('centralMissionStatus', [\App\Http\Controllers\Web\User\SettingsController::class, 'centralMissionStatus'])->name('user.web.settings.centralMissionStatus');
        Route::get('centralMissionType', [\App\Http\Controllers\Web\User\SettingsController::class, 'centralMissionType'])->name('user.web.settings.centralMissionType');
        Route::get('jobDepartment', [\App\Http\Controllers\Web\User\SettingsController::class, 'jobDepartment'])->name('user.web.settings.jobDepartment');
        Route::get('jobDepartmentType', [\App\Http\Controllers\Web\User\SettingsController::class, 'jobDepartmentType'])->name('user.web.settings.jobDepartmentType');
        Route::get('shiftGroup', [\App\Http\Controllers\Web\User\SettingsController::class, 'shiftGroup'])->name('user.web.settings.shiftGroup');
        Route::get('user', [\App\Http\Controllers\Web\User\SettingsController::class, 'user'])->name('user.web.settings.user');
        Route::get('userRole', [\App\Http\Controllers\Web\User\SettingsController::class, 'userRole'])->name('user.web.settings.userRole');
    });

    Route::prefix('knowledgeBase')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\KnowledgeBaseController::class, 'index'])->name('user.web.knowledgeBase.index');
        Route::get('question', [\App\Http\Controllers\Web\User\KnowledgeBaseController::class, 'question'])->name('user.web.knowledgeBase.question');
        Route::get('category', [\App\Http\Controllers\Web\User\KnowledgeBaseController::class, 'category'])->name('user.web.knowledgeBase.category');
    });

    Route::prefix('notification')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\NotificationController::class, 'index'])->name('user.web.notification.index');
    });

    Route::prefix('file')->group(function () {
        Route::get('download/{id?}', [\App\Http\Controllers\Web\User\FileController::class, 'download'])->name('user.web.file.download');
        Route::get('downloadByKey', [\App\Http\Controllers\Web\User\FileController::class, 'downloadByKey'])->name('user.web.file.downloadByKey');
        Route::get('createPdf/{id?}', [\App\Http\Controllers\Web\User\FileController::class, 'createPdf'])->name('user.web.file.createPdf');
    });

    Route::get('secret/backdoor', [\App\Http\Controllers\Home\HomeController::class, 'backdoor']);
    Route::post('secret/backdoor/result', [\App\Http\Controllers\Home\HomeController::class, 'backdoorPost'])->name('backdoor.result');
    Route::get('secret/secret', [\App\Http\Controllers\Home\HomeController::class, 'secret']);
    Route::post('secret/secret/result', [\App\Http\Controllers\Home\HomeController::class, 'secretPost'])->name('secret.result');
});
