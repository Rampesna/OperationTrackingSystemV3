<?php

namespace App\Providers;

use App\Interfaces\Eloquent\ICompetenceService;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IJobDepartmentService;
use App\Interfaces\Eloquent\IPersonalAccessTokenService;
use App\Interfaces\Eloquent\IQueueService;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Interfaces\Eloquent\IShiftService;
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
use App\Services\Eloquent\CompetenceService;
use App\Services\Eloquent\EmployeeService;
use App\Services\Eloquent\JobDepartmentService;
use App\Services\Eloquent\PersonalAccessTokenService;
use App\Services\Eloquent\QueueService;
use App\Services\Eloquent\ShiftGroupService;
use App\Services\Eloquent\ShiftService;
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
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IEmployeeService::class, EmployeeService::class);
        $this->app->bind(IJobDepartmentService::class, JobDepartmentService::class);
        $this->app->bind(IQueueService::class, QueueService::class);
        $this->app->bind(ICompetenceService::class, CompetenceService::class);
        $this->app->bind(IShiftGroupService::class, ShiftGroupService::class);
        $this->app->bind(IPersonalAccessTokenService::class, PersonalAccessTokenService::class);
        $this->app->bind(\App\Interfaces\Eloquent\ISpecialReportService::class, \App\Services\Eloquent\SpecialReportService::class);
        $this->app->bind(IShiftService::class, ShiftService::class);

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
