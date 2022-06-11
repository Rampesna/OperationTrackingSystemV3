<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\User\UserController::class, 'login'])->name('user.api.login');
});

Route::middleware([
    'auth:user_api'
])->group(function () {

    Route::get('getCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'getCompanies'])->name('user.api.getCompanies');
    Route::post('swapCompany', [\App\Http\Controllers\Api\User\UserController::class, 'swapCompany'])->name('user.api.swapCompany');
    Route::post('swapTheme', [\App\Http\Controllers\Api\User\UserController::class, 'swapTheme'])->name('user.api.swapTheme');

    Route::prefix('employee')->group(function () {
        Route::get('getByCompanies', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByCompanies'])->name('user.api.employee.getByCompanies');
        Route::get('getByEmail', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByEmail'])->name('user.api.employee.getByEmail');
        Route::post('create', [\App\Http\Controllers\Api\User\EmployeeController::class, 'create'])->name('user.api.employee.create');
        Route::post('updateJobDepartment', [\App\Http\Controllers\Api\User\EmployeeController::class, 'updateJobDepartment'])->name('user.api.employee.updateJobDepartment');
    });

    Route::prefix('jobDepartment')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'getByCompanyId'])->name('user.api.jobDepartment.getByCompanyId');
    });

    Route::prefix('operation')->group(function () {
        Route::get('getUserList', [\App\Http\Controllers\Api\User\OperationController::class, 'getUserList'])->name('user.api.operation.getUserList');
        Route::get('getEmployeeTasks', [\App\Http\Controllers\Api\User\OperationController::class, 'getEmployeeTasks'])->name('user.api.operation.getEmployeeTasks');
        Route::get('getEmployeeTasksEdit', [\App\Http\Controllers\Api\User\OperationController::class, 'getEmployeeTasksEdit'])->name('user.api.operation.getEmployeeTasksEdit');
        Route::post('setEmployeeTasksInsert', [\App\Http\Controllers\Api\User\OperationController::class, 'setEmployeeTasksInsert'])->name('user.api.operation.setEmployeeTasksInsert');
        Route::get('getEmployeeWorkTasks', [\App\Http\Controllers\Api\User\OperationController::class, 'getEmployeeWorkTasks'])->name('user.api.operation.getEmployeeWorkTasks');
        Route::get('getEmployeeWorkTasksEdit', [\App\Http\Controllers\Api\User\OperationController::class, 'getEmployeeWorkTasksEdit'])->name('user.api.operation.getEmployeeWorkTasksEdit');
        Route::post('setEmployeeWorkTasksInsert', [\App\Http\Controllers\Api\User\OperationController::class, 'setEmployeeWorkTasksInsert'])->name('user.api.operation.setEmployeeWorkTasksInsert');
        Route::get('getEmployeeGroupTasks', [\App\Http\Controllers\Api\User\OperationController::class, 'getEmployeeGroupTasks'])->name('user.api.operation.getEmployeeGroupTasks');
        Route::get('getEmployeeGroupTasksEdit', [\App\Http\Controllers\Api\User\OperationController::class, 'getEmployeeGroupTasksEdit'])->name('user.api.operation.getEmployeeGroupTasksEdit');
        Route::post('setEmployeeGroupTasksInsert', [\App\Http\Controllers\Api\User\OperationController::class, 'setEmployeeGroupTasksInsert'])->name('user.api.operation.setEmployeeGroupTasksInsert');
        Route::post('setEmployee', [\App\Http\Controllers\Api\User\OperationController::class, 'setEmployee'])->name('user.api.operation.setEmployee');
        Route::get('getDataScreening', [\App\Http\Controllers\Api\User\OperationController::class, 'getDataScreening'])->name('user.api.operation.getDataScreening');
    });

    Route::prefix('personSystem')->group(function () {
        Route::get('getPersonDataScanList', [\App\Http\Controllers\Api\User\PersonSystemController::class, 'getPersonDataScanList'])->name('user.api.personSystem.getPersonDataScanList');
        Route::post('setPersonAuthority', [\App\Http\Controllers\Api\User\PersonSystemController::class, 'setPersonAuthority'])->name('user.api.personSystem.setPersonAuthority');
        Route::post('setPersonDataScan', [\App\Http\Controllers\Api\User\PersonSystemController::class, 'setPersonDataScan'])->name('user.api.personSystem.setPersonDataScan');
        Route::post('setPersonDisplayType', [\App\Http\Controllers\Api\User\PersonSystemController::class, 'setPersonDisplayType'])->name('user.api.personSystem.setPersonDisplayType');
        Route::post('setPersonWorkToDoType', [\App\Http\Controllers\Api\User\PersonSystemController::class, 'setPersonWorkToDoType'])->name('user.api.personSystem.setPersonWorkToDoType');
    });

    Route::prefix('surveySystem')->group(function () {
        Route::get('getSurveyList', [\App\Http\Controllers\Api\User\SurveySystemController::class, 'getSurveyList'])->name('user.api.surveySystem.getSurveyList');
        Route::post('setSurveyPersonConnect', [\App\Http\Controllers\Api\User\SurveySystemController::class, 'setSurveyPersonConnect'])->name('user.api.surveySystem.setSurveyPersonConnect');
    });

    Route::prefix('dataScanning')->group(function () {
        Route::get('getDataScanTables', [\App\Http\Controllers\Api\User\DataScanningController::class, 'getDataScanTables'])->name('user.api.dataScanning.getDataScanTables');
        Route::get('getDataScanNumbersList', [\App\Http\Controllers\Api\User\DataScanningController::class, 'getDataScanNumbersList'])->name('user.api.dataScanning.getDataScanNumbersList');
        Route::get('getDataScanningDetails', [\App\Http\Controllers\Api\User\DataScanningController::class, 'getDataScanningDetails'])->name('user.api.dataScanning.getDataScanningDetails');
        Route::get('getDataScanSummaryList', [\App\Http\Controllers\Api\User\DataScanningController::class, 'getDataScanSummaryList'])->name('user.api.dataScanning.getDataScanSummaryList');
    });

    Route::prefix('personReport')->group(function () {
        Route::get('getPersonAppointmentReport', [\App\Http\Controllers\Api\User\PersonReportController::class, 'getPersonAppointmentReport'])->name('user.api.personReport.getPersonAppointmentReport');
    });

    Route::prefix('queue')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\QueueController::class, 'getByCompanyId'])->name('user.api.queue.getByCompanyId');
    });

    Route::prefix('competence')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\CompetenceController::class, 'getByCompanyId'])->name('user.api.competence.getByCompanyId');
    });

    Route::prefix('shiftGroup')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'getByCompanyId'])->name('user.api.shiftGroup.getByCompanyId');
        Route::get('getById', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'getById'])->name('user.api.shiftGroup.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'create'])->name('user.api.shiftGroup.create');
        Route::put('update', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'update'])->name('user.api.shiftGroup.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\ShiftGroupController::class, 'delete'])->name('user.api.shiftGroup.delete');
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
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\SpecialReportController::class, 'getByCompanyId'])->name('user.api.specialReport.getByCompanyId');
    });

    Route::prefix('operationSpecialReport')->group(function () {
        Route::get('getSpecialReport', [\App\Http\Controllers\Api\User\OperationSpecialReportController::class, 'getSpecialReport'])->name('user.api.operationSpecialReport.getSpecialReport');
    });

    Route::prefix('shift')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\ShiftController::class, 'getAll'])->name('user.api.shift.getAll');
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\ShiftController::class, 'getByCompanyId'])->name('user.api.shift.getByCompanyId');
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\ShiftController::class, 'getByCompanyIds'])->name('user.api.shift.getByCompanyIds');
    });
});
