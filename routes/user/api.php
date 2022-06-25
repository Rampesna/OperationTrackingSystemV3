<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\User\UserController::class, 'login'])->name('user.api.login');
    Route::post('sendPasswordResetEmail', [\App\Http\Controllers\Api\User\UserController::class, 'sendPasswordResetEmail'])->name('api.user.sendPasswordResetEmail');
    Route::post('resetPassword', [\App\Http\Controllers\Api\User\UserController::class, 'resetPassword'])->name('api.user.resetPassword');
});

Route::middleware([
    'auth:user_api',
    'UserCheckSuspend'
])->group(function () {

    Route::get('getCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'getCompanies'])->name('user.api.getCompanies');
    Route::post('setCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'setCompanies'])->name('user.api.setCompanies');
    Route::post('setSingleCompany', [\App\Http\Controllers\Api\User\UserController::class, 'setSingleCompany'])->name('user.api.setSingleCompany');
    Route::get('getSelectedCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'getSelectedCompanies'])->name('user.api.getSelectedCompanies');
    Route::post('setSelectedCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'setSelectedCompanies'])->name('user.api.setSelectedCompanies');
    Route::post('swapTheme', [\App\Http\Controllers\Api\User\UserController::class, 'swapTheme'])->name('user.api.swapTheme');

    Route::prefix('user')->group(function () {
        Route::get('getById', [\App\Http\Controllers\Api\User\UserController::class, 'getById'])->name('user.api.user.getById');
        Route::get('getByEmail', [\App\Http\Controllers\Api\User\UserController::class, 'getByEmail'])->name('user.api.user.getByEmail');
        Route::post('create', [\App\Http\Controllers\Api\User\UserController::class, 'create'])->name('user.api.user.create');
        Route::post('setUserCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'setUserCompanies'])->name('user.api.user.setUserCompanies');
        Route::put('update', [\App\Http\Controllers\Api\User\UserController::class, 'update'])->name('user.api.user.update');
        Route::put('setSuspend', [\App\Http\Controllers\Api\User\UserController::class, 'setSuspend'])->name('user.api.user.setSuspend');
        Route::delete('delete', [\App\Http\Controllers\Api\User\UserController::class, 'delete'])->name('user.api.user.delete');
    });

    Route::prefix('userRole')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\UserRoleController::class, 'getAll'])->name('user.api.userRole.getAll');
        Route::get('getAllUserRoles', [\App\Http\Controllers\Api\User\UserRoleController::class, 'getAllUserRoles'])->name('user.api.userRole.getAllUserRoles');
        Route::get('getById', [\App\Http\Controllers\Api\User\UserRoleController::class, 'getById'])->name('user.api.userRole.getById');
        Route::get('getUserPermissions', [\App\Http\Controllers\Api\User\UserRoleController::class, 'getUserPermissions'])->name('user.api.userRole.getUserPermissions');
        Route::post('setUserPermissions', [\App\Http\Controllers\Api\User\UserRoleController::class, 'setUserPermissions'])->name('user.api.userRole.setUserPermissions');
        Route::post('create', [\App\Http\Controllers\Api\User\UserRoleController::class, 'create'])->name('user.api.userRole.create');
        Route::put('update', [\App\Http\Controllers\Api\User\UserRoleController::class, 'update'])->name('user.api.userRole.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\UserRoleController::class, 'delete'])->name('user.api.userRole.delete');
    });

    Route::prefix('userPermission')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\UserPermissionController::class, 'getAll'])->name('user.api.userPermission.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\UserPermissionController::class, 'getById'])->name('user.api.userPermission.getById');
        Route::get('getByTopId', [\App\Http\Controllers\Api\User\UserPermissionController::class, 'getByTopId'])->name('user.api.userPermission.getByTopId');
    });

    Route::prefix('company')->group(function () {
        Route::get('getUsersByCompanyIds', [\App\Http\Controllers\Api\User\CompanyController::class, 'getUsersByCompanyIds'])->name('user.api.company.getUsersByCompanyIds');
        Route::get('tree', [\App\Http\Controllers\Api\User\CompanyController::class, 'tree'])->name('user.api.company.tree');
        Route::get('getById', [\App\Http\Controllers\Api\User\CompanyController::class, 'getById'])->name('user.api.company.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\CompanyController::class, 'create'])->name('user.api.company.create');
        Route::put('update', [\App\Http\Controllers\Api\User\CompanyController::class, 'update'])->name('user.api.company.update');
    });

    Route::prefix('commercialCompany')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\CommercialCompanyController::class, 'getAll'])->name('user.api.commercialCompany.getAll');
    });

    Route::prefix('branch')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\BranchController::class, 'getAll'])->name('user.api.branch.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\BranchController::class, 'getById'])->name('user.api.branch.getById');
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\BranchController::class, 'getByCompanyId'])->name('user.api.branch.getByCompanyId');
        Route::post('create', [\App\Http\Controllers\Api\User\BranchController::class, 'create'])->name('user.api.branch.create');
        Route::put('update', [\App\Http\Controllers\Api\User\BranchController::class, 'update'])->name('user.api.branch.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\BranchController::class, 'delete'])->name('user.api.branch.delete');
    });

    Route::prefix('department')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\DepartmentController::class, 'getAll'])->name('user.api.department.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\DepartmentController::class, 'getById'])->name('user.api.department.getById');
        Route::get('getByBranchId', [\App\Http\Controllers\Api\User\DepartmentController::class, 'getByBranchId'])->name('user.api.department.getByBranchId');
        Route::post('create', [\App\Http\Controllers\Api\User\DepartmentController::class, 'create'])->name('user.api.department.create');
        Route::put('update', [\App\Http\Controllers\Api\User\DepartmentController::class, 'update'])->name('user.api.department.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\DepartmentController::class, 'delete'])->name('user.api.department.delete');
    });

    Route::prefix('title')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\TitleController::class, 'getAll'])->name('user.api.title.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\TitleController::class, 'getById'])->name('user.api.title.getById');
        Route::get('getByDepartmentId', [\App\Http\Controllers\Api\User\TitleController::class, 'getByDepartmentId'])->name('user.api.title.getByDepartmentId');
        Route::post('create', [\App\Http\Controllers\Api\User\TitleController::class, 'create'])->name('user.api.title.create');
        Route::put('update', [\App\Http\Controllers\Api\User\TitleController::class, 'update'])->name('user.api.title.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\TitleController::class, 'delete'])->name('user.api.title.delete');
    });

    Route::prefix('employee')->group(function () {
        Route::get('getByCompanies', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByCompanies'])->name('user.api.employee.getByCompanies');
        Route::get('getByJobDepartmentTypeIds', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByJobDepartmentTypeIds'])->name('user.api.employee.getByJobDepartmentTypeIds');
        Route::get('getByEmail', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByEmail'])->name('user.api.employee.getByEmail');
        Route::post('create', [\App\Http\Controllers\Api\User\EmployeeController::class, 'create'])->name('user.api.employee.create');
        Route::post('updateJobDepartment', [\App\Http\Controllers\Api\User\EmployeeController::class, 'updateJobDepartment'])->name('user.api.employee.updateJobDepartment');
    });

    Route::prefix('jobDepartment')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'getByCompanyIds'])->name('user.api.jobDepartment.getByCompanyIds');
        Route::get('getById', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'getById'])->name('user.api.jobDepartment.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'create'])->name('user.api.jobDepartment.create');
        Route::put('update', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'update'])->name('user.api.jobDepartment.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'delete'])->name('user.api.jobDepartment.delete');
    });

    Route::prefix('queue')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\QueueController::class, 'getByCompanyIds'])->name('user.api.queue.getByCompanyIds');
        Route::get('getById', [\App\Http\Controllers\Api\User\QueueController::class, 'getById'])->name('user.api.queue.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\QueueController::class, 'create'])->name('user.api.queue.create');
        Route::put('update', [\App\Http\Controllers\Api\User\QueueController::class, 'update'])->name('user.api.queue.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\QueueController::class, 'delete'])->name('user.api.queue.delete');
    });

    Route::prefix('competence')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\CompetenceController::class, 'getByCompanyIds'])->name('user.api.competence.getByCompanyIds');
        Route::get('getById', [\App\Http\Controllers\Api\User\CompetenceController::class, 'getById'])->name('user.api.competence.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\CompetenceController::class, 'create'])->name('user.api.competence.create');
        Route::put('update', [\App\Http\Controllers\Api\User\CompetenceController::class, 'update'])->name('user.api.competence.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\CompetenceController::class, 'delete'])->name('user.api.competence.delete');
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
        Route::get('getById', [\App\Http\Controllers\Api\User\JobDepartmentTypeController::class, 'getById'])->name('user.api.jobDepartmentType.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\JobDepartmentTypeController::class, 'create'])->name('user.api.jobDepartmentType.create');
        Route::put('update', [\App\Http\Controllers\Api\User\JobDepartmentTypeController::class, 'update'])->name('user.api.jobDepartmentType.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\JobDepartmentTypeController::class, 'delete'])->name('user.api.jobDepartmentType.delete');
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

    Route::prefix('project')->group(function () {
        Route::get('getByUserId', [\App\Http\Controllers\Api\User\ProjectController::class, 'getByUserId'])->name('user.api.project.getByUserId');
        Route::get('getById', [\App\Http\Controllers\Api\User\ProjectController::class, 'getById'])->name('user.api.project.getById');
        Route::get('getSubtasksByProjectId', [\App\Http\Controllers\Api\User\ProjectController::class, 'getSubtasksByProjectId'])->name('user.api.project.getSubtasksByProjectId');
        Route::get('getBoardsByProjectId', [\App\Http\Controllers\Api\User\ProjectController::class, 'getBoardsByProjectId'])->name('user.api.project.getBoardsByProjectId');
    });

    Route::prefix('task')->group(function () {
        Route::get('getById', [\App\Http\Controllers\Api\User\TaskController::class, 'getById'])->name('user.api.task.getById');
        Route::get('getFilesById', [\App\Http\Controllers\Api\User\TaskController::class, 'getFilesById'])->name('user.api.task.getFilesById');
        Route::get('getSubTasksById', [\App\Http\Controllers\Api\User\TaskController::class, 'getSubTasksById'])->name('user.api.task.getSubTasksById');
        Route::get('getCommentsById', [\App\Http\Controllers\Api\User\TaskController::class, 'getCommentsById'])->name('user.api.task.getCommentsById');
        Route::put('updateBoard', [\App\Http\Controllers\Api\User\TaskController::class, 'updateBoard'])->name('user.api.task.updateBoard');
        Route::put('updateOrder', [\App\Http\Controllers\Api\User\TaskController::class, 'updateOrder'])->name('user.api.task.updateOrder');
        Route::put('updateByParameters', [\App\Http\Controllers\Api\User\TaskController::class, 'updateByParameters'])->name('user.api.task.updateByParameters');
        Route::delete('delete', [\App\Http\Controllers\Api\User\TaskController::class, 'delete'])->name('user.api.task.delete');
    });

    Route::prefix('board')->group(function () {
        Route::put('updateOrder', [\App\Http\Controllers\Api\User\BoardController::class, 'updateOrder'])->name('user.api.board.updateOrder');
    });

    Route::prefix('subTask')->group(function () {
        Route::get('getByProjectId', [\App\Http\Controllers\Api\User\SubTaskController::class, 'getByProjectId'])->name('user.api.subTask.getByProjectId');
        Route::get('getByProjectIds', [\App\Http\Controllers\Api\User\SubTaskController::class, 'getByProjectIds'])->name('user.api.subTask.getByProjectIds');
        Route::post('create', [\App\Http\Controllers\Api\User\SubTaskController::class, 'create'])->name('user.api.subTask.create');
        Route::put('update', [\App\Http\Controllers\Api\User\SubTaskController::class, 'update'])->name('user.api.subTask.update');
        Route::put('setChecked', [\App\Http\Controllers\Api\User\SubTaskController::class, 'setChecked'])->name('user.api.subTask.setChecked');
        Route::delete('delete', [\App\Http\Controllers\Api\User\SubTaskController::class, 'delete'])->name('user.api.subTask.delete');
    });

    Route::prefix('taskPriority')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\TaskPriorityController::class, 'getAll'])->name('user.api.taskPriority.getAll');
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
            Route::post('setDataScanning', [\App\Http\Controllers\Api\User\OperationApi\DataScanningController::class, 'setDataScanning'])->name('user.api.operationApi.dataScanning.setDataScanning');
            Route::post('setCallDataScanning', [\App\Http\Controllers\Api\User\OperationApi\DataScanningController::class, 'setCallDataScanning'])->name('user.api.operationApi.dataScanning.setCallDataScanning');
        });

        Route::prefix('surveySystem')->group(function () {
            Route::get('getSurveyList', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyList'])->name('user.api.operationApi.surveySystem.getSurveyList');
            Route::post('setSurveyPersonConnect', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyPersonConnect'])->name('user.api.operationApi.surveySystem.setSurveyPersonConnect');
            Route::post('setSurvey', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurvey'])->name('user.api.operationApi.surveySystem.setSurvey');
            Route::get('getSurveyEdit', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyEdit'])->name('user.api.operationApi.surveySystem.getSurveyEdit');
            Route::post('setSurveyDelete', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyDelete'])->name('user.api.operationApi.surveySystem.setSurveyDelete');
            Route::post('setSurveyGroupConnect', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyGroupConnect'])->name('user.api.operationApi.surveySystem.setSurveyGroupConnect');
            Route::get('getSurveyQuestionsList', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyQuestionsList'])->name('user.api.operationApi.surveySystem.getSurveyQuestionsList');
            Route::get('getSurveyAnswersList', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyAnswersList'])->name('user.api.operationApi.surveySystem.getSurveyAnswersList');
            Route::get('getSurveyQuestionEdit', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyQuestionEdit'])->name('user.api.operationApi.surveySystem.getSurveyQuestionEdit');
            Route::get('getSurveyProductList', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyProductList'])->name('user.api.operationApi.surveySystem.getSurveyProductList');
            Route::get('getSurveyAnswerEdit', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyAnswerEdit'])->name('user.api.operationApi.surveySystem.getSurveyAnswerEdit');
            Route::get('getSurveyAnswersCategoryConnectList', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyAnswersCategoryConnectList'])->name('user.api.operationApi.surveySystem.getSurveyAnswersCategoryConnectList');
            Route::get('getSurveyAnswersConnectList', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyAnswersConnectList'])->name('user.api.operationApi.surveySystem.getSurveyAnswersConnectList');
            Route::get('getSurveyAnswersProductConnectList', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyAnswersProductConnectList'])->name('user.api.operationApi.surveySystem.getSurveyAnswersProductConnectList');
            Route::post('setSurveyQuestions', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyQuestions'])->name('user.api.operationApi.surveySystem.setSurveyQuestions');
            Route::post('setSurveyQuestionsDelete', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyQuestionsDelete'])->name('user.api.operationApi.surveySystem.setSurveyQuestionsDelete');
            Route::post('setSurveyAnswers', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyAnswers'])->name('user.api.operationApi.surveySystem.setSurveyAnswers');
            Route::post('setSurveyAnswersCategoryConnect', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyAnswersCategoryConnect'])->name('user.api.operationApi.surveySystem.setSurveyAnswersCategoryConnect');
            Route::post('setSurveyAnswersConnect', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyAnswersConnect'])->name('user.api.operationApi.surveySystem.setSurveyAnswersConnect');
            Route::post('setSurveyAnswersProductConnect', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyAnswersProductConnect'])->name('user.api.operationApi.surveySystem.setSurveyAnswersProductConnect');
            Route::post('setSurveyAnswersDelete', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyAnswersDelete'])->name('user.api.operationApi.surveySystem.setSurveyAnswersDelete');
            Route::get('getSurveyReport', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyReport'])->name('user.api.operationApi.surveySystem.getSurveyReport');
            Route::get('getSurveyReportWantedDetails', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyReportWantedDetails'])->name('user.api.operationApi.surveySystem.getSurveyReportWantedDetails');
            Route::get('getSurveyReportRemainingDetails', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyReportRemainingDetails'])->name('user.api.operationApi.surveySystem.getSurveyReportRemainingDetails');
            Route::get('getSurveyReportStatusDetails', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyReportStatusDetails'])->name('user.api.operationApi.surveySystem.getSurveyReportStatusDetails');
            Route::get('getSurveyDetailReport', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyDetailReport'])->name('user.api.operationApi.surveySystem.getSurveyDetailReport');
            Route::get('getSurveyDetailReportGroupById', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyDetailReportGroupById'])->name('user.api.operationApi.surveySystem.getSurveyDetailReportGroupById');
        });

        Route::prefix('jobsSystem')->group(function () {
            Route::post('setJobsExcel', [\App\Http\Controllers\Api\User\OperationApi\JobsSystemController::class, 'setJobsExcel'])->name('user.api.operationApi.jobsSystem.setJobsExcel');
            Route::post('setJobsClosedExcel', [\App\Http\Controllers\Api\User\OperationApi\JobsSystemController::class, 'setJobsClosedExcel'])->name('user.api.operationApi.jobsSystem.setJobsClosedExcel');
            Route::post('setJobSuspend', [\App\Http\Controllers\Api\User\OperationApi\JobsSystemController::class, 'setJobSuspend'])->name('user.api.operationApi.jobsSystem.setJobSuspend');
            Route::post('setJobCaseWorkDelete', [\App\Http\Controllers\Api\User\OperationApi\JobsSystemController::class, 'setJobCaseWorkDelete'])->name('user.api.operationApi.jobsSystem.setJobCaseWorkDelete');
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
