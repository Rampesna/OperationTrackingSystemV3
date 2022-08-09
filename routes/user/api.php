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

    Route::get('getProfile', [\App\Http\Controllers\Api\User\UserController::class, 'getProfile'])->name('user.api.getProfile');
    Route::get('getCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'getCompanies'])->name('user.api.getCompanies');
    Route::post('setCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'setCompanies'])->name('user.api.setCompanies');
    Route::post('setSingleCompany', [\App\Http\Controllers\Api\User\UserController::class, 'setSingleCompany'])->name('user.api.setSingleCompany');
    Route::get('getSelectedCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'getSelectedCompanies'])->name('user.api.getSelectedCompanies');
    Route::post('setSelectedCompanies', [\App\Http\Controllers\Api\User\UserController::class, 'setSelectedCompanies'])->name('user.api.setSelectedCompanies');
    Route::post('swapTheme', [\App\Http\Controllers\Api\User\UserController::class, 'swapTheme'])->name('user.api.swapTheme');

    Route::prefix('user')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\UserController::class, 'getAll'])->name('user.api.user.getAll');
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
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByCompanyIds'])->name('user.api.employee.getByCompanyIds');
        Route::get('getByCompanyIdsWithPersonalInformation', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByCompanyIdsWithPersonalInformation'])->name('user.api.employee.getByCompanyIdsWithPersonalInformation');
        Route::get('getByCompanyIdsWithBalance', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByCompanyIdsWithBalance'])->name('user.api.employee.getByCompanyIdsWithBalance');
        Route::get('getByCompanyIdsWithDevices', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByCompanyIdsWithDevices'])->name('user.api.employee.getByCompanyIdsWithDevices');
        Route::get('getByJobDepartmentTypeIds', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByJobDepartmentTypeIds'])->name('user.api.employee.getByJobDepartmentTypeIds');
        Route::get('getById', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getById'])->name('user.api.employee.getById');
        Route::get('getByEmail', [\App\Http\Controllers\Api\User\EmployeeController::class, 'getByEmail'])->name('user.api.employee.getByEmail');
        Route::post('create', [\App\Http\Controllers\Api\User\EmployeeController::class, 'create'])->name('user.api.employee.create');
        Route::post('updateJobDepartment', [\App\Http\Controllers\Api\User\EmployeeController::class, 'updateJobDepartment'])->name('user.api.employee.updateJobDepartment');
    });

    Route::prefix('employeePersonalInformation')->group(function () {
        Route::get('getByEmployeeId', [\App\Http\Controllers\Api\User\EmployeePersonalInformationController::class, 'getByEmployeeId'])->name('user.api.employeePersonalInformation.getByEmployeeId');
        Route::put('update', [\App\Http\Controllers\Api\User\EmployeePersonalInformationController::class, 'update'])->name('user.api.employeePersonalInformation.update');
    });

    Route::prefix('position')->group(function () {
        Route::get('getByEmployeeId', [\App\Http\Controllers\Api\User\PositionController::class, 'getByEmployeeId'])->name('user.api.position.getByEmployeeId');
        Route::get('getById', [\App\Http\Controllers\Api\User\PositionController::class, 'getById'])->name('user.api.position.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\PositionController::class, 'create'])->name('user.api.position.create');
        Route::put('update', [\App\Http\Controllers\Api\User\PositionController::class, 'update'])->name('user.api.position.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\PositionController::class, 'delete'])->name('user.api.position.delete');
    });

    Route::prefix('leavingReason')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\LeavingReasonController::class, 'getAll'])->name('user.api.leavingReason.getAll');
    });

    Route::prefix('jobDepartment')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'getByCompanyIds'])->name('user.api.jobDepartment.getByCompanyIds');
        Route::get('getById', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'getById'])->name('user.api.jobDepartment.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'create'])->name('user.api.jobDepartment.create');
        Route::put('update', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'update'])->name('user.api.jobDepartment.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\JobDepartmentController::class, 'delete'])->name('user.api.jobDepartment.delete');
    });

    Route::prefix('device')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\DeviceController::class, 'getByCompanyIds'])->name('user.api.device.getByCompanyIds');
        Route::get('paginateByEmployeeId', [\App\Http\Controllers\Api\User\DeviceController::class, 'paginateByEmployeeId'])->name('user.api.device.paginateByEmployeeId');
        Route::get('getById', [\App\Http\Controllers\Api\User\DeviceController::class, 'getById'])->name('user.api.device.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\DeviceController::class, 'create'])->name('user.api.device.create');
        Route::put('update', [\App\Http\Controllers\Api\User\DeviceController::class, 'update'])->name('user.api.device.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\DeviceController::class, 'delete'])->name('user.api.device.delete');
    });

    Route::prefix('deviceCategory')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\DeviceCategoryController::class, 'getAll'])->name('user.api.deviceCategory.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\DeviceCategoryController::class, 'getById'])->name('user.api.deviceCategory.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\DeviceCategoryController::class, 'create'])->name('user.api.deviceCategory.create');
        Route::put('update', [\App\Http\Controllers\Api\User\DeviceCategoryController::class, 'update'])->name('user.api.deviceCategory.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\DeviceCategoryController::class, 'delete'])->name('user.api.deviceCategory.delete');
    });

    Route::prefix('deviceStatus')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\DeviceStatusController::class, 'getAll'])->name('user.api.deviceStatus.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\DeviceStatusController::class, 'getById'])->name('user.api.deviceStatus.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\DeviceStatusController::class, 'create'])->name('user.api.deviceStatus.create');
        Route::put('update', [\App\Http\Controllers\Api\User\DeviceStatusController::class, 'update'])->name('user.api.deviceStatus.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\DeviceStatusController::class, 'delete'])->name('user.api.deviceStatus.delete');
    });

    Route::prefix('devicePackage')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\DevicePackageController::class, 'getAll'])->name('user.api.devicePackage.getAll');
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\DevicePackageController::class, 'getByCompanyIds'])->name('user.api.devicePackage.getByCompanyIds');
        Route::get('getById', [\App\Http\Controllers\Api\User\DevicePackageController::class, 'getById'])->name('user.api.devicePackage.getById');
        Route::get('getDevices', [\App\Http\Controllers\Api\User\DevicePackageController::class, 'getDevices'])->name('user.api.devicePackage.getDevices');
        Route::post('setDevices', [\App\Http\Controllers\Api\User\DevicePackageController::class, 'setDevices'])->name('user.api.devicePackage.setDevices');
        Route::post('updateEmployee', [\App\Http\Controllers\Api\User\DevicePackageController::class, 'updateEmployee'])->name('user.api.devicePackage.updateEmployee');
        Route::post('create', [\App\Http\Controllers\Api\User\DevicePackageController::class, 'create'])->name('user.api.devicePackage.create');
        Route::put('update', [\App\Http\Controllers\Api\User\DevicePackageController::class, 'update'])->name('user.api.devicePackage.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\DevicePackageController::class, 'delete'])->name('user.api.devicePackage.delete');
    });

    Route::prefix('academyEducation')->group(function () {
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\AcademyEducationController::class, 'getByCompanyIds'])->name('user.api.academyEducation.getByCompanyIds');
        Route::get('getById', [\App\Http\Controllers\Api\User\AcademyEducationController::class, 'getById'])->name('user.api.academyEducation.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\AcademyEducationController::class, 'create'])->name('user.api.academyEducation.create');
        Route::put('update', [\App\Http\Controllers\Api\User\AcademyEducationController::class, 'update'])->name('user.api.academyEducation.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\AcademyEducationController::class, 'delete'])->name('user.api.academyEducation.delete');
    });

    Route::prefix('academyEducationLesson')->group(function () {
        Route::get('getByAcademyEducationId', [\App\Http\Controllers\Api\User\AcademyEducationLessonController::class, 'getByAcademyEducationId'])->name('user.api.academyEducationLesson.getByAcademyEducationId');
        Route::post('create', [\App\Http\Controllers\Api\User\AcademyEducationLessonController::class, 'create'])->name('user.api.academyEducationLesson.create');
        Route::put('updateByParameters', [\App\Http\Controllers\Api\User\AcademyEducationLessonController::class, 'updateByParameters'])->name('user.api.academyEducationLesson.updateByParameters');
        Route::delete('delete', [\App\Http\Controllers\Api\User\AcademyEducationLessonController::class, 'delete'])->name('user.api.academyEducationLesson.delete');
    });

    Route::prefix('academyEducationPlan')->group(function () {
        Route::get('getDateBetweenByCompanyIds', [\App\Http\Controllers\Api\User\AcademyEducationPlanController::class, 'getDateBetweenByCompanyIds'])->name('user.api.academyEducationPlan.getDateBetweenByCompanyIds');
        Route::get('getById', [\App\Http\Controllers\Api\User\AcademyEducationPlanController::class, 'getById'])->name('user.api.academyEducationPlan.getById');
        Route::post('createBatch', [\App\Http\Controllers\Api\User\AcademyEducationPlanController::class, 'createBatch'])->name('user.api.academyEducationPlan.createBatch');
        Route::put('update', [\App\Http\Controllers\Api\User\AcademyEducationPlanController::class, 'update'])->name('user.api.academyEducationPlan.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\AcademyEducationPlanController::class, 'delete'])->name('user.api.academyEducationPlan.delete');
    });

    Route::prefix('academyEducationPlanParticipant')->group(function () {
        Route::get('getByAcademyEducationPlanId', [\App\Http\Controllers\Api\User\AcademyEducationPlanParticipantController::class, 'getByAcademyEducationPlanId'])->name('user.api.academyEducationPlanParticipant.getByAcademyEducationPlanId');
        Route::post('syncAcademyEducationPlanParticipants', [\App\Http\Controllers\Api\User\AcademyEducationPlanParticipantController::class, 'syncAcademyEducationPlanParticipants'])->name('user.api.academyEducationPlanParticipant.syncAcademyEducationPlanParticipants');
        Route::put('setAttendance', [\App\Http\Controllers\Api\User\AcademyEducationPlanParticipantController::class, 'setAttendance'])->name('user.api.academyEducationPlanParticipant.setAttendance');
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
        Route::get('getById', [\App\Http\Controllers\Api\User\SpecialReportController::class, 'getById'])->name('user.api.specialReport.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\SpecialReportController::class, 'create'])->name('user.api.specialReport.create');
        Route::put('update', [\App\Http\Controllers\Api\User\SpecialReportController::class, 'update'])->name('user.api.specialReport.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\SpecialReportController::class, 'delete'])->name('user.api.specialReport.delete');
    });

    Route::prefix('meeting')->group(function () {
        Route::get('getDateBetweenByUserId', [\App\Http\Controllers\Api\User\MeetingController::class, 'getDateBetweenByUserId'])->name('user.api.meeting.getDateBetweenByUserId');
        Route::get('getById', [\App\Http\Controllers\Api\User\MeetingController::class, 'getById'])->name('user.api.meeting.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\MeetingController::class, 'create'])->name('user.api.meeting.create');
        Route::put('update', [\App\Http\Controllers\Api\User\MeetingController::class, 'update'])->name('user.api.meeting.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\MeetingController::class, 'delete'])->name('user.api.meeting.delete');
    });

    Route::prefix('meetingType')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\MeetingTypeController::class, 'getAll'])->name('user.api.meetingType.getAll');
    });

    Route::prefix('meetingUser')->group(function () {
        Route::get('getMeetingUsers', [\App\Http\Controllers\Api\User\MeetingUserController::class, 'getMeetingUsers'])->name('user.api.meetingUser.getMeetingUsers');
        Route::post('setMeetingUsers', [\App\Http\Controllers\Api\User\MeetingUserController::class, 'setMeetingUsers'])->name('user.api.meetingUser.setMeetingUsers');
        Route::get('getUserMeetings', [\App\Http\Controllers\Api\User\MeetingUserController::class, 'getUserMeetings'])->name('user.api.meetingUser.getUserMeetings');
        Route::post('setUserMeetings', [\App\Http\Controllers\Api\User\MeetingUserController::class, 'setUserMeetings'])->name('user.api.meetingUser.setUserMeetings');
    });

    Route::prefix('shift')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\ShiftController::class, 'getAll'])->name('user.api.shift.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\ShiftController::class, 'getById'])->name('user.api.shift.getById');
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\User\ShiftController::class, 'getByCompanyId'])->name('user.api.shift.getByCompanyId');
        Route::get('getByEmployeeId', [\App\Http\Controllers\Api\User\ShiftController::class, 'getByEmployeeId'])->name('user.api.shift.getByEmployeeId');
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\ShiftController::class, 'getByCompanyIds'])->name('user.api.shift.getByCompanyIds');
        Route::post('createBatch', [\App\Http\Controllers\Api\User\ShiftController::class, 'createBatch'])->name('user.api.shift.createBatch');
        Route::put('update', [\App\Http\Controllers\Api\User\ShiftController::class, 'update'])->name('user.api.shift.update');
        Route::post('robot', [\App\Http\Controllers\Api\User\ShiftController::class, 'robot'])->name('user.api.shift.robot');
        Route::delete('delete', [\App\Http\Controllers\Api\User\ShiftController::class, 'delete'])->name('user.api.shift.delete');
        Route::delete('deleteByIds', [\App\Http\Controllers\Api\User\ShiftController::class, 'deleteByIds'])->name('user.api.shift.deleteByIds');
    });

    Route::prefix('file')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\FileController::class, 'getAll'])->name('user.api.file.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\FileController::class, 'getById'])->name('user.api.file.getById');
        Route::get('getByRelation', [\App\Http\Controllers\Api\User\FileController::class, 'getByRelation'])->name('user.api.file.getByRelation');
        Route::post('upload', [\App\Http\Controllers\Api\User\FileController::class, 'upload'])->name('user.api.file.upload');
        Route::post('uploadBatch', [\App\Http\Controllers\Api\User\FileController::class, 'uploadBatch'])->name('user.api.file.uploadBatch');
        Route::get('download', [\App\Http\Controllers\Api\User\FileController::class, 'download'])->name('user.api.file.download');
        Route::delete('delete', [\App\Http\Controllers\Api\User\FileController::class, 'delete'])->name('user.api.file.delete');
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
        Route::post('create', [\App\Http\Controllers\Api\User\TaskController::class, 'create'])->name('user.api.task.create');
        Route::put('updateBoard', [\App\Http\Controllers\Api\User\TaskController::class, 'updateBoard'])->name('user.api.task.updateBoard');
        Route::put('updateOrder', [\App\Http\Controllers\Api\User\TaskController::class, 'updateOrder'])->name('user.api.task.updateOrder');
        Route::put('updateByParameters', [\App\Http\Controllers\Api\User\TaskController::class, 'updateByParameters'])->name('user.api.task.updateByParameters');
        Route::delete('delete', [\App\Http\Controllers\Api\User\TaskController::class, 'delete'])->name('user.api.task.delete');
    });

    Route::prefix('board')->group(function () {
        Route::post('create', [\App\Http\Controllers\Api\User\BoardController::class, 'create'])->name('user.api.board.create');
        Route::put('updateName', [\App\Http\Controllers\Api\User\BoardController::class, 'updateName'])->name('user.api.board.updateName');
        Route::put('updateOrder', [\App\Http\Controllers\Api\User\BoardController::class, 'updateOrder'])->name('user.api.board.updateOrder');
        Route::delete('delete', [\App\Http\Controllers\Api\User\BoardController::class, 'delete'])->name('user.api.board.delete');
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

    Route::prefix('permit')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\PermitController::class, 'getAll'])->name('user.api.permit.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\PermitController::class, 'getById'])->name('user.api.permit.getById');
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\PermitController::class, 'getByCompanyIds'])->name('user.api.permit.getByCompanyIds');
        Route::get('getByEmployeeId', [\App\Http\Controllers\Api\User\PermitController::class, 'getByEmployeeId'])->name('user.api.permit.getByEmployeeId');
        Route::get('getDateBetweenByEmployeeIdsAndTypeIds', [\App\Http\Controllers\Api\User\PermitController::class, 'getDateBetweenByEmployeeIdsAndTypeIds'])->name('user.api.permit.getDateBetweenByEmployeeIdsAndTypeIds');
        Route::get('getByStatusIdAndCompanyIds', [\App\Http\Controllers\Api\User\PermitController::class, 'getByStatusIdAndCompanyIds'])->name('user.api.permit.getByStatusIdAndCompanyIds');
        Route::get('getByDateAndCompanyIds', [\App\Http\Controllers\Api\User\PermitController::class, 'getByDateAndCompanyIds'])->name('user.api.permit.getByDateAndCompanyIds');
        Route::post('create', [\App\Http\Controllers\Api\User\PermitController::class, 'create'])->name('user.api.permit.create');
        Route::put('update', [\App\Http\Controllers\Api\User\PermitController::class, 'update'])->name('user.api.permit.update');
        Route::put('setStatus', [\App\Http\Controllers\Api\User\PermitController::class, 'setStatus'])->name('user.api.permit.setStatus');
        Route::delete('delete', [\App\Http\Controllers\Api\User\PermitController::class, 'delete'])->name('user.api.permit.delete');
    });

    Route::prefix('overtime')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\OvertimeController::class, 'getAll'])->name('user.api.overtime.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\OvertimeController::class, 'getById'])->name('user.api.overtime.getById');
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\OvertimeController::class, 'getByCompanyIds'])->name('user.api.overtime.getByCompanyIds');
        Route::get('getByEmployeeId', [\App\Http\Controllers\Api\User\OvertimeController::class, 'getByEmployeeId'])->name('user.api.overtime.getByEmployeeId');
        Route::get('getDateBetweenByEmployeeIdsAndTypeIds', [\App\Http\Controllers\Api\User\OvertimeController::class, 'getDateBetweenByEmployeeIdsAndTypeIds'])->name('user.api.overtime.getDateBetweenByEmployeeIdsAndTypeIds');
        Route::get('getByStatusIdAndCompanyIds', [\App\Http\Controllers\Api\User\OvertimeController::class, 'getByStatusIdAndCompanyIds'])->name('user.api.overtime.getByStatusIdAndCompanyIds');
        Route::get('getByDateAndCompanyIds', [\App\Http\Controllers\Api\User\OvertimeController::class, 'getByDateAndCompanyIds'])->name('user.api.overtime.getByDateAndCompanyIds');
        Route::post('create', [\App\Http\Controllers\Api\User\OvertimeController::class, 'create'])->name('user.api.overtime.create');
        Route::put('update', [\App\Http\Controllers\Api\User\OvertimeController::class, 'update'])->name('user.api.overtime.update');
        Route::put('setStatus', [\App\Http\Controllers\Api\User\OvertimeController::class, 'setStatus'])->name('user.api.overtime.setStatus');
        Route::delete('delete', [\App\Http\Controllers\Api\User\OvertimeController::class, 'delete'])->name('user.api.overtime.delete');
    });

    Route::prefix('payment')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\PaymentController::class, 'getAll'])->name('user.api.payment.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\PaymentController::class, 'getById'])->name('user.api.payment.getById');
        Route::get('getByCompanyIds', [\App\Http\Controllers\Api\User\PaymentController::class, 'getByCompanyIds'])->name('user.api.payment.getByCompanyIds');
        Route::get('getByEmployeeId', [\App\Http\Controllers\Api\User\PaymentController::class, 'getByEmployeeId'])->name('user.api.payment.getByEmployeeId');
        Route::get('getByStatusIdAndCompanyIds', [\App\Http\Controllers\Api\User\PaymentController::class, 'getByStatusIdAndCompanyIds'])->name('user.api.payment.getByStatusIdAndCompanyIds');
        Route::get('getByDateAndCompanyIds', [\App\Http\Controllers\Api\User\PaymentController::class, 'getByDateAndCompanyIds'])->name('user.api.payment.getByDateAndCompanyIds');
        Route::post('create', [\App\Http\Controllers\Api\User\PaymentController::class, 'create'])->name('user.api.payment.create');
        Route::put('update', [\App\Http\Controllers\Api\User\PaymentController::class, 'update'])->name('user.api.payment.update');
        Route::put('setStatus', [\App\Http\Controllers\Api\User\PaymentController::class, 'setStatus'])->name('user.api.payment.setStatus');
        Route::delete('delete', [\App\Http\Controllers\Api\User\PaymentController::class, 'delete'])->name('user.api.payment.delete');
    });

    Route::prefix('permitType')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\PermitTypeController::class, 'getAll'])->name('user.api.permitType.getAll');
    });

    Route::prefix('overtimeType')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\OvertimeTypeController::class, 'getAll'])->name('user.api.overtimeType.getAll');
    });

    Route::prefix('paymentType')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\PaymentTypeController::class, 'getAll'])->name('user.api.paymentType.getAll');
    });

    Route::prefix('ticket')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\TicketController::class, 'getAll'])->name('user.api.ticket.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\TicketController::class, 'getById'])->name('user.api.ticket.getById');
        Route::get('getByRelation', [\App\Http\Controllers\Api\User\TicketController::class, 'getByRelation'])->name('user.api.ticket.getByRelation');
        Route::get('getByCreator', [\App\Http\Controllers\Api\User\TicketController::class, 'getByCreator'])->name('user.api.ticket.getByCreator');
        Route::post('create', [\App\Http\Controllers\Api\User\TicketController::class, 'create'])->name('user.api.ticket.create');
        Route::put('update', [\App\Http\Controllers\Api\User\TicketController::class, 'update'])->name('user.api.ticket.update');
        Route::put('setStatus', [\App\Http\Controllers\Api\User\TicketController::class, 'setStatus'])->name('user.api.ticket.setStatus');
        Route::delete('delete', [\App\Http\Controllers\Api\User\TicketController::class, 'delete'])->name('user.api.ticket.delete');
    });

    Route::prefix('ticketMessage')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\TicketMessageController::class, 'getAll'])->name('user.api.ticketMessage.getAll');
        Route::get('getById', [\App\Http\Controllers\Api\User\TicketMessageController::class, 'getById'])->name('user.api.ticketMessage.getById');
        Route::get('getByRelation', [\App\Http\Controllers\Api\User\TicketMessageController::class, 'getByTicketId'])->name('user.api.ticketMessage.getByTicketId');
        Route::post('create', [\App\Http\Controllers\Api\User\TicketMessageController::class, 'create'])->name('user.api.ticketMessage.create');
        Route::put('update', [\App\Http\Controllers\Api\User\TicketMessageController::class, 'update'])->name('user.api.ticketMessage.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\TicketMessageController::class, 'delete'])->name('user.api.ticketMessage.delete');
    });

    Route::prefix('ticketPriority')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\TicketPriorityController::class, 'getAll'])->name('user.api.ticketPriority.getAll');
    });

    Route::prefix('ticketStatus')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\TicketStatusController::class, 'getAll'])->name('user.api.ticketStatus.getAll');
    });

    Route::prefix('comment')->group(function () {
        Route::get('getByRelation', [\App\Http\Controllers\Api\User\CommentController::class, 'getByRelation'])->name('user.api.comment.getByRelation');
        Route::post('create', [\App\Http\Controllers\Api\User\CommentController::class, 'create'])->name('user.api.comment.create');
    });

    Route::prefix('market')->group(function () {
        Route::get('index', [\App\Http\Controllers\Api\User\MarketController::class, 'index'])->name('user.api.market.index');
        Route::get('getById', [\App\Http\Controllers\Api\User\MarketController::class, 'getById'])->name('user.api.market.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\MarketController::class, 'create'])->name('user.api.market.create');
        Route::put('update', [\App\Http\Controllers\Api\User\MarketController::class, 'update'])->name('user.api.market.update');
        Route::delete('delete', [\App\Http\Controllers\Api\User\MarketController::class, 'delete'])->name('user.api.market.delete');
    });

    Route::prefix('marketPayment')->group(function () {
        Route::post('addBalanceEmployees', [\App\Http\Controllers\Api\User\MarketPaymentController::class, 'addBalanceEmployees'])->name('user.api.marketPayment.addBalanceEmployees');
        Route::post('create', [\App\Http\Controllers\Api\User\MarketPaymentController::class, 'create'])->name('user.api.marketPayment.create');
    });

    Route::prefix('centralMission')->group(function () {
        Route::get('getByRelation', [\App\Http\Controllers\Api\User\CentralMissionController::class, 'getByRelation'])->name('user.api.centralMission.getByRelation');
        Route::get('getById', [\App\Http\Controllers\Api\User\CentralMissionController::class, 'getById'])->name('user.api.centralMission.getById');
        Route::post('create', [\App\Http\Controllers\Api\User\CentralMissionController::class, 'create'])->name('user.api.centralMission.create');
        Route::put('update', [\App\Http\Controllers\Api\User\CentralMissionController::class, 'update'])->name('user.api.centralMission.update');
        Route::put('updateDiagram', [\App\Http\Controllers\Api\User\CentralMissionController::class, 'updateDiagram'])->name('user.api.centralMission.updateDiagram');
        Route::delete('delete', [\App\Http\Controllers\Api\User\CentralMissionController::class, 'delete'])->name('user.api.centralMission.delete');
    });

    Route::prefix('centralMissionType')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\CentralMissionTypeController::class, 'getAll'])->name('user.api.centralMissionType.getAll');
    });

    Route::prefix('centralMissionStatus')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\User\CentralMissionStatusController::class, 'getAll'])->name('user.api.centralMissionStatus.getAll');
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
            Route::post('setStaffParameter', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'setStaffParameter'])->name('user.api.operationApi.operation.setStaffParameter');
            Route::get('getStaffParameterEdit', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'getStaffParameterEdit'])->name('user.api.operationApi.operation.getStaffParameterEdit');
            Route::post('setStaffParameterDelete', [\App\Http\Controllers\Api\User\OperationApi\OperationController::class, 'setStaffParameterDelete'])->name('user.api.operationApi.operation.setStaffParameterDelete');
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
            Route::get('getSurveyProductEdit', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveyProductEdit'])->name('user.api.operationApi.surveySystem.getSurveyProductEdit');
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
            Route::get('getSurveySellerList', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'getSurveySellerList'])->name('user.api.operationApi.surveySystem.getSurveySellerList');
            Route::post('setSurveySellerConnect', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveySellerConnect'])->name('user.api.operationApi.surveySystem.setSurveySellerConnect');
            Route::post('setSurveySellerDelete', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveySellerDelete'])->name('user.api.operationApi.surveySystem.setSurveySellerDelete');
            Route::post('setSurveyProduct', [\App\Http\Controllers\Api\User\OperationApi\SurveySystemController::class, 'setSurveyProduct'])->name('user.api.operationApi.surveySystem.setSurveyProduct');
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
