<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\User\UserController::class, 'login'])->name('user.api.login');
});

Route::middleware([
    'auth:user_api'
])->group(function () {

    Route::get('getCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'getCompanies'])->name('user.api.getCompanies');
    Route::post('setCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'setCompanies'])->name('user.api.setCompanies');
    Route::get('getSelectedCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'getSelectedCompanies'])->name('user.api.getSelectedCompanies');
    Route::post('setSelectedCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'setSelectedCompanies'])->name('user.api.setSelectedCompanies');
    Route::post('swapTheme', [\App\Http\Controllers\Api\User\UserController::class, 'swapTheme'])->name('user.api.swapTheme');

    Route::prefix('employee')->group(function () {
        Route::get('getByCompanies', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByCompanies'])->name('user.api.employee.getByCompanies');
        Route::get('getByJobDepartmentTypeIds', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByJobDepartmentTypeIds'])->name('user.api.employee.getByJobDepartmentTypeIds');
        Route::get('getByEmail', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByEmail'])->name('user.api.employee.getByEmail');
        Route::post('create', [\App\Http\Controllers\Api\User\EmployeeController::class, 'create'])->name('user.api.employee.create');
        Route::post('updateJobDepartment', [\App\Http\Controllers\Api\User\EmployeeController::class, 'updateJobDepartment'])->name('user.api.employee.updateJobDepartment');
    });

    Route::prefix('jobDepartment')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'getByCompanyIds'])->name('user.api.jobDepartment.getByCompanyIds');
    });

    Route::prefix('queue')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\QueueController::class, 'getByCompanyIds'])->name('user.api.queue.getByCompanyIds');
    });

    Route::prefix('competence')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\CompetenceController::class, 'getByCompanyIds'])->name('user.api.competence.getByCompanyIds');
    });

    Route::prefix('shiftGroup')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'getByCompanyIds'])->name('user.api.shiftGroup.getByCompanyIds');
        Route::get('getById', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'getById'])->name('user.api.shiftGroup.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'create'])->name('user.api.shiftGroup.create');
        Route::put('update', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'update'])->name('user.api.shiftGroup.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'delete'])->name('user.api.shiftGroup.delete');
    });

    Route::prefix('jobDepartmentType')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\JobDepartmentTypeController::class, 'getByCompanyIds'])->name('user.api.jobDepartmentType.getByCompanyIds');
    });

    Route::prefix('employeeQueue')->group(function () {
        Route::get('getEmployeeQueues', [\App\Http\Controllers\Api\User\EmployeeQueueController::class, 'getEmployeeQueues'])->name('user.api.employeeQueue.getEmployeeQueues');
        Route::post('setEmployeeQueues', [\App\Http\Controllers\Api\User\EmployeeQueueController::class, 'setEmployeeQueues'])->name('user.api.employeeQueue.setEmployeeQueues');
        Route::get('getQueueEmployees', [\App\Http\Controllers\Api\User\EmployeeQueueController::class, 'getQueueEmployees'])->name('user.api.employeeQueue.getQueueEmployees');
        Route::post('setQueueEmployees', [\App\Http\Controllers\Api\User\EmployeeQueueController::class, 'setQueueEmployees'])->name('user.api.employeeQueue.setQueueEmployees');
    });

    Route::prefix('competenceEmployee')->group(function () {
        Route::get('getEmployeeCompetences', [\App\Http\Controllers\Api\User\CompetenceEmployeeController::class, 'getEmployeeCompetences'])->name('user.api.competenceEmployee.getEmployeeCompetences');
        Route::post('setEmployeeCompetences', [\App\Http\Controllers\Api\User\CompetenceEmployeeController::class, 'setEmployeeCompetences'])->name('user.api.competenceEmployee.setEmployeeCompetences');
        Route::get('getCompetenceEmployees', [\App\Http\Controllers\Api\User\CompetenceEmployeeController::class, 'getCompetenceEmployees'])->name('user.api.competenceEmployee.getCompetenceEmployees');
        Route::post('setCompetenceEmployees', [\App\Http\Controllers\Api\User\CompetenceEmployeeController::class, 'setCompetenceEmployees'])->name('user.api.competenceEmployee.setCompetenceEmployees');
    });

    Route::prefix('employeeShiftGroup')->group(function () {
        Route::get('getEmployeeShiftGroups', [\App\Http\Controllers\Api\User\EmployeeShiftGroupController::class, 'getEmployeeShiftGroups'])->name('user.api.employeeShiftGroup.getEmployeeShiftGroups');
        Route::post('setEmployeeShiftGroups', [\App\Http\Controllers\Api\User\EmployeeShiftGroupController::class, 'setEmployeeShiftGroups'])->name('user.api.employeeShiftGroup.setEmployeeShiftGroups');
        Route::get('getShiftGroupEmployees', [\App\Http\Controllers\Api\User\EmployeeShiftGroupController::class, 'getShiftGroupEmployees'])->name('user.api.employeeShiftGroup.getShiftGroupEmployees');
        Route::post('setShiftGroupEmployees', [\App\Http\Controllers\Api\User\EmployeeShiftGroupController::class, 'setShiftGroupEmployees'])->name('user.api.employeeShiftGroup.setShiftGroupEmployees');
    });

    Route::prefix('specialReport')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\SpecialReportController::class, 'getByCompanyIds'])->name('user.api.specialReport.getByCompanyIds');
    });

    Route::prefix('shift')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\ShiftController::class, 'getAll'])->name('user.api.shift.getAll');
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\ShiftController::class, 'getByCompanyId'])->name('user.api.shift.getByCompanyId');
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\ShiftController::class, 'getByCompanyIds'])->name('user.api.shift.getByCompanyIds');
    });

    Route::prefix('operationApi')->group(function () {
        Route::prefix('operation')->group(function () {
            Route::get('getUserList', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'getUserList'])->name('user.api.operationApi.operation.getUserList');
            Route::get('getEmployeeTasks', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'getEmployeeTasks'])->name('user.api.operationApi.operation.getEmployeeTasks');
            Route::get('getEmployeeTasksEdit', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'getEmployeeTasksEdit'])->name('user.api.operationApi.operation.getEmployeeTasksEdit');
            Route::post('setEmployeeTasksInsert', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'setEmployeeTasksInsert'])->name('user.api.operationApi.operation.setEmployeeTasksInsert');
            Route::get('getEmployeeWorkTasks', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'getEmployeeWorkTasks'])->name('user.api.operationApi.operation.getEmployeeWorkTasks');
            Route::get('getEmployeeWorkTasksEdit', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'getEmployeeWorkTasksEdit'])->name('user.api.operationApi.operation.getEmployeeWorkTasksEdit');
            Route::post('setEmployeeWorkTasksInsert', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'setEmployeeWorkTasksInsert'])->name('user.api.operationApi.operation.setEmployeeWorkTasksInsert');
            Route::get('getEmployeeGroupTasks', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'getEmployeeGroupTasks'])->name('user.api.operationApi.operation.getEmployeeGroupTasks');
            Route::get('getEmployeeGroupTasksEdit', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'getEmployeeGroupTasksEdit'])->name('user.api.operationApi.operation.getEmployeeGroupTasksEdit');
            Route::post('setEmployeeGroupTasksInsert', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'setEmployeeGroupTasksInsert'])->name('user.api.operationApi.operation.setEmployeeGroupTasksInsert');
            Route::post('setEmployee', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'setEmployee'])->name('user.api.operationApi.operation.setEmployee');
            Route::get('getDataScreening', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'getDataScreening'])->name('user.api.operationApi.operation.getDataScreening');
        });

        Route::prefix('personSystem')->group(function () {
            Route::get('getPersonDataScanList', [\App\Http\Controllers\Api\User\OperationApi\PersonSystemController::class, 'getPersonDataScanList'])->name('user.api.operationApi.personSystem.getPersonDataScanList');
            Route::post('setPersonAuthority', [\App\Http\Controllers\Api\User\OperationApi\PersonSystemController::class, 'setPersonAuthority'])->name('user.api.operationApi.personSystem.setPersonAuthority');
            Route::post('setPersonDataScan', [\App\Http\Controllers\Api\User\OperationApi\PersonSystemController::class, 'setPersonDataScan'])->name('user.api.operationApi.personSystem.setPersonDataScan');
            Route::post('setPersonDisplayType', [\App\Http\Controllers\Api\User\OperationApi\PersonSystemController::class, 'setPersonDisplayType'])->name('user.api.operationApi.personSystem.setPersonDisplayType');
            Route::post('setPersonWorkToDoType', [\App\Http\Controllers\Api\User\OperationApi\PersonSystemController::class, 'setPersonWorkToDoType'])->name('user.api.operationApi.personSystem.setPersonWorkToDoType');
        });

        Route::prefix('tvScreen')->group(function () {
            Route::get('getJobList', [\App\Http\Controllers\Api\User\OperationApi\TvScreenController::class, 'getJobList'])->name('user.api.operationApi.tvScreen.getJobList');
            Route::get('getStaffStatusList', [\App\Http\Controllers\Api\User\OperationApi\TvScreenController::class, 'getStaffStatusList'])->name('user.api.operationApi.tvScreen.getStaffStatusList');
            Route::get('getStaffStatusUserList', [\App\Http\Controllers\Api\User\OperationApi\TvScreenController::class, 'getStaffStatusUserList'])->name('user.api.operationApi.tvScreen.getStaffStatusUserList');
        });

        Route::prefix('specialReport')->group(function () {
            Route::get('getSpecialReport', [\App\Http\Controllers\Api\User\OperationApi\SpecialReportController::class, 'getSpecialReport'])->name('user.api.operationApi.specialReport.getSpecialReport');
        });

        Route::prefix('personReport')->group(function () {
            Route::get('getPersonAppointmentReport', [\App\Http\Controllers\Api\User\OperationApi\PersonReportController::class, 'getPersonAppointmentReport'])->name('user.api.operationApi.personReport.getPersonAppointmentReport');
            Route::get('getPersonnelAchievementRanking', [\App\Http\Controllers\Api\User\OperationApi\PersonReportController::class, 'getPersonnelAchievementRanking'])->name('user.api.operationApi.personReport.getPersonnelAchievementRanking');
        });

        Route::prefix('dataScanning')->group(function () {
            Route::get('getDataScanTables', [\App\Http\Controllers\Api\User\OperationApi\DataScanningController::class, 'getDataScanTables'])->name('user.api.operationApi.dataScanning.getDataScanTables');
            Route::get('getDataScanNumbersList', [\App\Http\Controllers\Api\User\OperationApi\DataScanningController::class, 'getDataScanNumbersList'])->name('user.api.operationApi.dataScanning.getDataScanNumbersList');
            Route::get('getDataScanningDetails', [\App\Http\Controllers\Api\User\OperationApi\DataScanningController::class, 'getDataScanningDetails'])->name('user.api.operationApi.dataScanning.getDataScanningDetails');
            Route::get('getDataScanSummaryList', [\App\Http\Controllers\Api\User\OperationApi\DataScanningController::class, 'getDataScanSummaryList'])->name('user.api.operationApi.dataScanning.getDataScanSummaryList');
        });

        Route::prefix('surveySystem')->group(function () {
            Route::get('getSurveyList', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyList'])->name('user.api.operationApi.surveySystem.getSurveyList');
            Route::post('setSurveyPersonConnect', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyPersonConnect'])->name('user.api.operationApi.surveySystem.setSurveyPersonConnect');
        });
    });

    Route::prefix('otsCallApi')->group(function () {
        Route::prefix('tvScreen')->group(function () {
            Route::get('getSantral', [\App\Http\Controllers\Api\User\OtsCallApi\TvScreenController::class, 'getSantral'])->name('user.api.otsCallApi.tvScreen.getSantral');
        });
    });

    Route::prefix('netsantralApi')->group(function () {
        Route::get('getSantral', [\App\Http\Controllers\Api\User\NetsantralApi\NetsantralApiController::class, 'getSantral'])->name('user.api.netsantralApi.getSantral');
    });
});
