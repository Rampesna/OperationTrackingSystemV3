<?php

namespace App\Providers;

use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IUserService;
use App\Interfaces\OperationApi\IDataScanningService;
use App\Interfaces\OperationApi\IExamSystemService;
use App\Interfaces\OperationApi\IJobsSystemService;
use App\Interfaces\OperationApi\IOperationService;
use App\Interfaces\OperationApi\IOtsSystemService;
use App\Interfaces\OperationApi\IPersonReportService;
use App\Interfaces\OperationApi\ISpecialReportService;
use App\Interfaces\OperationApi\ISurveySystemService;
use App\Interfaces\OperationApi\ITvScreenService;
use App\Services\Eloquent\EmployeeService;
use App\Services\Eloquent\UserService;
use App\Services\OperationApi\DataScanningService;
use App\Services\OperationApi\ExamSystemService;
use App\Services\OperationApi\JobsSystemService;
use App\Services\OperationApi\OperationService;
use App\Services\OperationApi\OtsSystemService;
use App\Services\OperationApi\PersonReportService;
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

        // OperationApiServices
        $this->app->bind(IDataScanningService::class, DataScanningService::class);
        $this->app->bind(IExamSystemService::class, ExamSystemService::class);
        $this->app->bind(IJobsSystemService::class, JobsSystemService::class);
        $this->app->bind(IOperationService::class, OperationService::class);
        $this->app->bind(IOtsSystemService::class, OtsSystemService::class);
        $this->app->bind(IPersonReportService::class, PersonReportService::class);
        $this->app->bind(ISpecialReportService::class, SpecialReportService::class);
        $this->app->bind(ISurveySystemService::class, SurveySystemService::class);
        $this->app->bind(ITvScreenService::class, TvScreenService::class);
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
