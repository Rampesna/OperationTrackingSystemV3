<?php

namespace App\Providers;

use App\Interfaces\Eloquent\IBoardService;
use App\Interfaces\Eloquent\IBranchService;
use App\Interfaces\Eloquent\ICommercialCompanyService;
use App\Interfaces\Eloquent\ICompanyService;
use App\Interfaces\Eloquent\ICompetenceService;
use App\Interfaces\Eloquent\IDepartmentService;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IJobDepartmentService;
use App\Interfaces\Eloquent\IJobDepartmentTypeService;
use App\Interfaces\Eloquent\IPasswordResetService;
use App\Interfaces\Eloquent\IPersonalAccessTokenService;
use App\Interfaces\Eloquent\IProjectService;
use App\Interfaces\Eloquent\IQueueService;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Interfaces\Eloquent\IShiftService;
use App\Interfaces\Eloquent\ISubTaskService;
use App\Interfaces\Eloquent\ITaskPriorityService;
use App\Interfaces\Eloquent\ITaskService;
use App\Interfaces\Eloquent\ITitleService;
use App\Interfaces\Eloquent\IUserPermissionService;
use App\Interfaces\Eloquent\IUserRoleService;
use App\Interfaces\Eloquent\IUserService;
use App\Interfaces\NetsantralApi\INetsantralApiService;
use App\Interfaces\OperationApi\IDataScanningService;
use App\Interfaces\OperationApi\IExamSystemService;
use App\Interfaces\OperationApi\IJobsSystemService;
use App\Interfaces\OperationApi\IOperationService;
use App\Interfaces\OperationApi\IOtsSystemService;
use App\Interfaces\OperationApi\IPersonReportService;
use App\Interfaces\OperationApi\IPersonSystemService;
use App\Interfaces\OperationApi\ISpecialReportService;
use App\Interfaces\OperationApi\ISurveySystemService;
use App\Interfaces\OperationApi\ITvScreenService;
use App\Services\Eloquent\BoardService;
use App\Services\Eloquent\BranchService;
use App\Services\Eloquent\CommercialCompanyService;
use App\Services\Eloquent\CompanyService;
use App\Services\Eloquent\CompetenceService;
use App\Services\Eloquent\DepartmentService;
use App\Services\Eloquent\EmployeeService;
use App\Services\Eloquent\JobDepartmentService;
use App\Services\Eloquent\JobDepartmentTypeService;
use App\Services\Eloquent\PasswordResetService;
use App\Services\Eloquent\PersonalAccessTokenService;
use App\Services\Eloquent\ProjectService;
use App\Services\Eloquent\QueueService;
use App\Services\Eloquent\ShiftGroupService;
use App\Services\Eloquent\ShiftService;
use App\Services\Eloquent\SubTaskService;
use App\Services\Eloquent\TaskPriorityService;
use App\Services\Eloquent\TaskService;
use App\Services\Eloquent\TitleService;
use App\Services\Eloquent\UserPermissionService;
use App\Services\Eloquent\UserRoleService;
use App\Services\Eloquent\UserService;
use App\Services\NetsantralApi\NetsantralApiService;
use App\Services\OperationApi\DataScanningService;
use App\Services\OperationApi\ExamSystemService;
use App\Services\OperationApi\JobsSystemService;
use App\Services\OperationApi\OperationService;
use App\Services\OperationApi\OtsSystemService;
use App\Services\OperationApi\PersonReportService;
use App\Services\OperationApi\PersonSystemService;
use App\Services\OperationApi\SpecialReportService;
use App\Services\OperationApi\SurveySystemService;
use App\Services\OperationApi\TvScreenService;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Eloquent Services
        $this->app->bind(ICompanyService::class, CompanyService::class);
        $this->app->bind(IBranchService::class, BranchService::class);
        $this->app->bind(IDepartmentService::class, DepartmentService::class);
        $this->app->bind(ITitleService::class, TitleService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IEmployeeService::class, EmployeeService::class);
        $this->app->bind(IJobDepartmentService::class, JobDepartmentService::class);
        $this->app->bind(IQueueService::class, QueueService::class);
        $this->app->bind(ICompetenceService::class, CompetenceService::class);
        $this->app->bind(IShiftGroupService::class, ShiftGroupService::class);
        $this->app->bind(IPersonalAccessTokenService::class, PersonalAccessTokenService::class);
        $this->app->bind(\App\Interfaces\Eloquent\ISpecialReportService::class, \App\Services\Eloquent\SpecialReportService::class);
        $this->app->bind(IShiftService::class, ShiftService::class);
        $this->app->bind(IJobDepartmentTypeService::class, JobDepartmentTypeService::class);
        $this->app->bind(ICommercialCompanyService::class, CommercialCompanyService::class);
        $this->app->bind(IProjectService::class, ProjectService::class);
        $this->app->bind(IBoardService::class, BoardService::class);
        $this->app->bind(ITaskService::class, TaskService::class);
        $this->app->bind(ISubTaskService::class, SubTaskService::class);
        $this->app->bind(ITaskPriorityService::class, TaskPriorityService::class);
        $this->app->bind(IUserRoleService::class, UserRoleService::class);
        $this->app->bind(IPasswordResetService::class, PasswordResetService::class);
        $this->app->bind(IUserPermissionService::class, UserPermissionService::class);

        // OperationApiServices
        $this->app->bind(IDataScanningService::class, DataScanningService::class);
        $this->app->bind(IExamSystemService::class, ExamSystemService::class);
        $this->app->bind(IJobsSystemService::class, JobsSystemService::class);
        $this->app->bind(IOperationService::class, OperationService::class);
        $this->app->bind(IOtsSystemService::class, OtsSystemService::class);
        $this->app->bind(IPersonReportService::class, PersonReportService::class);
        $this->app->bind(IPersonSystemService::class, PersonSystemService::class);
        $this->app->bind(ISpecialReportService::class, SpecialReportService::class);
        $this->app->bind(ISurveySystemService::class, SurveySystemService::class);
        $this->app->bind(ITvScreenService::class, TvScreenService::class);

        // OtsCallApiServices
        $this->app->bind(\App\Interfaces\OtsCallApi\ITvScreenService::class, \App\Services\OtsCallApi\TvScreenService::class);

        // NetsantralApiServices
        $this->app->bind(INetsantralApiService::class, NetsantralApiService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
