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
    });

    Route::prefix('jobDepartment')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'getByCompanyId'])->name('user.api.jobDepartment.getByCompanyId');
    });

    Route::prefix('operation')->group(function () {
        Route::get('getUserList', [\App\Http\Controllers\Api\User\OperationController::class, 'getUserList'])->name('user.api.operation.getUserList');
        Route::get('getEmployeeTasks', [\App\Http\Controllers\Api\User\OperationController::class, 'getEmployeeTasks'])->name('user.api.operation.getEmployeeTasks');
        Route::get('getEmployeeWorkTasks', [\App\Http\Controllers\Api\User\OperationController::class, 'getEmployeeWorkTasks'])->name('user.api.operation.getEmployeeWorkTasks');
        Route::get('getEmployeeGroupTasks', [\App\Http\Controllers\Api\User\OperationController::class, 'getEmployeeGroupTasks'])->name('user.api.operation.getEmployeeGroupTasks');
    });

    Route::prefix('personSystem')->group(function () {
        Route::post('setPersonAuthority', [\App\Http\Controllers\Api\User\PersonSystemController::class, 'setPersonAuthority'])->name('user.api.personSystem.setPersonAuthority');
        Route::post('getPersonDataScanList', [\App\Http\Controllers\Api\User\PersonSystemController::class, 'getPersonDataScanList'])->name('user.api.personSystem.getPersonDataScanList');
    });

    Route::prefix('surveySystem')->group(function () {
        Route::post('getSurveyList', [\App\Http\Controllers\Api\User\SurveySystemController::class, 'getSurveyList'])->name('user.api.surveySystem.getSurveyList');
    });

    Route::prefix('queue')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\QueueController::class, 'getByCompanyId'])->name('user.api.queue.getByCompanyId');
    });

    Route::prefix('competence')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\CompetenceController::class, 'getByCompanyId'])->name('user.api.competence.getByCompanyId');
    });

    Route::prefix('priority')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\PriorityController::class, 'getByCompanyId'])->name('user.api.priority.getByCompanyId');
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

});
