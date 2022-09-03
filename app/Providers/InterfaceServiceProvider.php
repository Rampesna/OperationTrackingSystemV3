<?php

namespace App\Providers;

use App\Interfaces\AwsS3\IStorageService;
use App\Interfaces\Eloquent\IAcademyEducationLessonService;
use App\Interfaces\Eloquent\IAcademyEducationPlanParticipantService;
use App\Interfaces\Eloquent\IAcademyEducationPlanService;
use App\Interfaces\Eloquent\IAcademyEducationService;
use App\Interfaces\Eloquent\IBoardService;
use App\Interfaces\Eloquent\IBranchService;
use App\Interfaces\Eloquent\ICareerService;
use App\Interfaces\Eloquent\ICentralMissionService;
use App\Interfaces\Eloquent\ICentralMissionStatusService;
use App\Interfaces\Eloquent\ICentralMissionTypeService;
use App\Interfaces\Eloquent\ICommentService;
use App\Interfaces\Eloquent\ICommercialCompanyService;
use App\Interfaces\Eloquent\ICompanyService;
use App\Interfaces\Eloquent\ICompetenceService;
use App\Interfaces\Eloquent\IDepartmentService;
use App\Interfaces\Eloquent\IDeviceCategoryService;
use App\Interfaces\Eloquent\IDevicePackageService;
use App\Interfaces\Eloquent\IDeviceService;
use App\Interfaces\Eloquent\IDeviceStatusService;
use App\Interfaces\Eloquent\IEmployeePersonalInformationService;
use App\Interfaces\Eloquent\IEmployeeQualityAssessmentService;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IEmployeeSuggestionService;
use App\Interfaces\Eloquent\IEvaluationParameterService;
use App\Interfaces\Eloquent\IFileService;
use App\Interfaces\Eloquent\IFoodListCheckService;
use App\Interfaces\Eloquent\IFoodListService;
use App\Interfaces\Eloquent\IJobDepartmentService;
use App\Interfaces\Eloquent\IJobDepartmentTypeService;
use App\Interfaces\Eloquent\ILeavingReasonService;
use App\Interfaces\Eloquent\IMarketPaymentService;
use App\Interfaces\Eloquent\IMarketService;
use App\Interfaces\Eloquent\IMeetingAgendaService;
use App\Interfaces\Eloquent\IMeetingService;
use App\Interfaces\Eloquent\IMeetingTypeService;
use App\Interfaces\Eloquent\IOvertimeService;
use App\Interfaces\Eloquent\IOvertimeTypeService;
use App\Interfaces\Eloquent\IPasswordResetService;
use App\Interfaces\Eloquent\IPaymentService;
use App\Interfaces\Eloquent\IPaymentTypeService;
use App\Interfaces\Eloquent\IPermitService;
use App\Interfaces\Eloquent\IPermitTypeService;
use App\Interfaces\Eloquent\IPersonalAccessTokenService;
use App\Interfaces\Eloquent\IPositionService;
use App\Interfaces\Eloquent\IProjectJobService;
use App\Interfaces\Eloquent\IProjectJobTypeService;
use App\Interfaces\Eloquent\IProjectLandingCustomerService;
use App\Interfaces\Eloquent\IProjectService;
use App\Interfaces\Eloquent\IProjectStatusService;
use App\Interfaces\Eloquent\IProjectVersionService;
use App\Interfaces\Eloquent\IPunishmentCategoryService;
use App\Interfaces\Eloquent\IPunishmentService;
use App\Interfaces\Eloquent\IPurchaseItemService;
use App\Interfaces\Eloquent\IPurchaseService;
use App\Interfaces\Eloquent\IPurchaseStatusService;
use App\Interfaces\Eloquent\IQualityAssessmentListService;
use App\Interfaces\Eloquent\IQueueService;
use App\Interfaces\Eloquent\IRecruitingDepartmentService;
use App\Interfaces\Eloquent\IRecruitingEvaluationParameterService;
use App\Interfaces\Eloquent\IRecruitingService;
use App\Interfaces\Eloquent\IRecruitingStepService;
use App\Interfaces\Eloquent\IRecruitingStepSubStepCheckService;
use App\Interfaces\Eloquent\IRecruitingStepSubStepService;
use App\Interfaces\Eloquent\ISaturdayPermitService;
use App\Interfaces\Eloquent\IShiftGroupEmployeeUseListService;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Interfaces\Eloquent\IShiftService;
use App\Interfaces\Eloquent\ISubTaskService;
use App\Interfaces\Eloquent\ITaskPriorityService;
use App\Interfaces\Eloquent\ITaskService;
use App\Interfaces\Eloquent\ITicketMessageService;
use App\Interfaces\Eloquent\ITicketPriorityService;
use App\Interfaces\Eloquent\ITicketService;
use App\Interfaces\Eloquent\ITicketStatusService;
use App\Interfaces\Eloquent\ITicketTransactionStatusService;
use App\Interfaces\Eloquent\ITitleService;
use App\Interfaces\Eloquent\IUserPermissionService;
use App\Interfaces\Eloquent\IUserRoleService;
use App\Interfaces\Eloquent\IUserService;
use App\Interfaces\MesajPaneli\IMesajPaneliService;
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
use App\Models\Eloquent\OvertimeType;
use App\Services\AwsS3\StorageService;
use App\Services\Eloquent\AcademyEducationLessonService;
use App\Services\Eloquent\AcademyEducationPlanParticipantService;
use App\Services\Eloquent\AcademyEducationPlanService;
use App\Services\Eloquent\AcademyEducationService;
use App\Services\Eloquent\BoardService;
use App\Services\Eloquent\BranchService;
use App\Services\Eloquent\CareerService;
use App\Services\Eloquent\CentralMissionService;
use App\Services\Eloquent\CentralMissionStatusService;
use App\Services\Eloquent\CentralMissionTypeService;
use App\Services\Eloquent\CommentService;
use App\Services\Eloquent\CommercialCompanyService;
use App\Services\Eloquent\CompanyService;
use App\Services\Eloquent\CompetenceService;
use App\Services\Eloquent\DepartmentService;
use App\Services\Eloquent\DeviceCategoryService;
use App\Services\Eloquent\DevicePackageService;
use App\Services\Eloquent\DeviceService;
use App\Services\Eloquent\DeviceStatusService;
use App\Services\Eloquent\EmployeePersonalInformationService;
use App\Services\Eloquent\EmployeeQualityAssessmentService;
use App\Services\Eloquent\EmployeeService;
use App\Services\Eloquent\EmployeeSuggestionService;
use App\Services\Eloquent\EvaluationParameterService;
use App\Services\Eloquent\FileService;
use App\Services\Eloquent\FoodListCheckService;
use App\Services\Eloquent\FoodListService;
use App\Services\Eloquent\JobDepartmentService;
use App\Services\Eloquent\JobDepartmentTypeService;
use App\Services\Eloquent\LeavingReasonService;
use App\Services\Eloquent\MarketPaymentService;
use App\Services\Eloquent\MarketService;
use App\Services\Eloquent\MeetingAgendaService;
use App\Services\Eloquent\MeetingService;
use App\Services\Eloquent\MeetingTypeService;
use App\Services\Eloquent\OvertimeService;
use App\Services\Eloquent\OvertimeTypeService;
use App\Services\Eloquent\PasswordResetService;
use App\Services\Eloquent\PaymentService;
use App\Services\Eloquent\PaymentTypeService;
use App\Services\Eloquent\PermitService;
use App\Services\Eloquent\PermitTypeService;
use App\Services\Eloquent\PersonalAccessTokenService;
use App\Services\Eloquent\PositionService;
use App\Services\Eloquent\ProjectJobService;
use App\Services\Eloquent\ProjectJobTypeService;
use App\Services\Eloquent\ProjectLandingCustomerService;
use App\Services\Eloquent\ProjectService;
use App\Services\Eloquent\ProjectStatusService;
use App\Services\Eloquent\ProjectVersionService;
use App\Services\Eloquent\PunishmentCategoryService;
use App\Services\Eloquent\PunishmentService;
use App\Services\Eloquent\PurchaseItemService;
use App\Services\Eloquent\PurchaseService;
use App\Services\Eloquent\PurchaseStatusService;
use App\Services\Eloquent\QualityAssessmentListService;
use App\Services\Eloquent\QueueService;
use App\Services\Eloquent\RecruitingDepartmentService;
use App\Services\Eloquent\RecruitingEvaluationParameterService;
use App\Services\Eloquent\RecruitingService;
use App\Services\Eloquent\RecruitingStepService;
use App\Services\Eloquent\RecruitingStepSubStepCheckService;
use App\Services\Eloquent\RecruitingStepSubStepService;
use App\Services\Eloquent\SaturdayPermitService;
use App\Services\Eloquent\ShiftGroupEmployeeUseListService;
use App\Services\Eloquent\ShiftGroupService;
use App\Services\Eloquent\ShiftService;
use App\Services\Eloquent\SubTaskService;
use App\Services\Eloquent\TaskPriorityService;
use App\Services\Eloquent\TaskService;
use App\Services\Eloquent\TicketMessageService;
use App\Services\Eloquent\TicketPriorityService;
use App\Services\Eloquent\TicketService;
use App\Services\Eloquent\TicketStatusService;
use App\Services\Eloquent\TicketTransactionStatusService;
use App\Services\Eloquent\TitleService;
use App\Services\Eloquent\UserPermissionService;
use App\Services\Eloquent\UserRoleService;
use App\Services\Eloquent\UserService;
use App\Services\MesajPaneli\MesajPaneliService;
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
        $this->app->bind(IShiftGroupEmployeeUseListService::class, ShiftGroupEmployeeUseListService::class);
        $this->app->bind(IPermitService::class, PermitService::class);
        $this->app->bind(IPermitTypeService::class, PermitTypeService::class);
        $this->app->bind(IOvertimeService::class, OvertimeService::class);
        $this->app->bind(IOvertimeTypeService::class, OvertimeTypeService::class);
        $this->app->bind(IPaymentService::class, PaymentService::class);
        $this->app->bind(IPaymentTypeService::class, PaymentTypeService::class);
        $this->app->bind(IFoodListService::class, FoodListService::class);
        $this->app->bind(IFoodListCheckService::class, FoodListCheckService::class);
        $this->app->bind(IMarketPaymentService::class, MarketPaymentService::class);
        $this->app->bind(IMarketService::class, MarketService::class);
        $this->app->bind(IAcademyEducationService::class, AcademyEducationService::class);
        $this->app->bind(IAcademyEducationLessonService::class, AcademyEducationLessonService::class);
        $this->app->bind(IAcademyEducationPlanService::class, AcademyEducationPlanService::class);
        $this->app->bind(IAcademyEducationPlanParticipantService::class, AcademyEducationPlanParticipantService::class);
        $this->app->bind(IMeetingService::class, MeetingService::class);
        $this->app->bind(IMeetingAgendaService::class, MeetingAgendaService::class);
        $this->app->bind(IMeetingTypeService::class, MeetingTypeService::class);
        $this->app->bind(IDeviceCategoryService::class, DeviceCategoryService::class);
        $this->app->bind(IDeviceStatusService::class, DeviceStatusService::class);
        $this->app->bind(IDeviceService::class, DeviceService::class);
        $this->app->bind(IDevicePackageService::class, DevicePackageService::class);
        $this->app->bind(IEmployeePersonalInformationService::class, EmployeePersonalInformationService::class);
        $this->app->bind(IPositionService::class, PositionService::class);
        $this->app->bind(ILeavingReasonService::class, LeavingReasonService::class);
        $this->app->bind(IFileService::class, FileService::class);
        $this->app->bind(ITicketService::class, TicketService::class);
        $this->app->bind(ITicketPriorityService::class, TicketPriorityService::class);
        $this->app->bind(ITicketStatusService::class, TicketStatusService::class);
        $this->app->bind(ITicketMessageService::class, TicketMessageService::class);
        $this->app->bind(ICommentService::class, CommentService::class);
        $this->app->bind(ICentralMissionService::class, CentralMissionService::class);
        $this->app->bind(ICentralMissionTypeService::class, CentralMissionTypeService::class);
        $this->app->bind(ICentralMissionStatusService::class, CentralMissionStatusService::class);
        $this->app->bind(ISaturdayPermitService::class, SaturdayPermitService::class);
        $this->app->bind(IPurchaseService::class, PurchaseService::class);
        $this->app->bind(IPurchaseStatusService::class, PurchaseStatusService::class);
        $this->app->bind(IPurchaseItemService::class, PurchaseItemService::class);
        $this->app->bind(IProjectStatusService::class, ProjectStatusService::class);
        $this->app->bind(IEmployeeSuggestionService::class, EmployeeSuggestionService::class);
        $this->app->bind(IEmployeeQualityAssessmentService::class, EmployeeQualityAssessmentService::class);
        $this->app->bind(IQualityAssessmentListService::class, QualityAssessmentListService::class);
        $this->app->bind(ICareerService::class, CareerService::class);
        $this->app->bind(IProjectVersionService::class, ProjectVersionService::class);
        $this->app->bind(IProjectJobService::class, ProjectJobService::class);
        $this->app->bind(IProjectJobTypeService::class, ProjectJobTypeService::class);
        $this->app->bind(IProjectLandingCustomerService::class, ProjectLandingCustomerService::class);
        $this->app->bind(IRecruitingService::class, RecruitingService::class);
        $this->app->bind(IEvaluationParameterService::class, EvaluationParameterService::class);
        $this->app->bind(IRecruitingStepService::class, RecruitingStepService::class);
        $this->app->bind(IRecruitingStepSubStepService::class, RecruitingStepSubStepService::class);
        $this->app->bind(IRecruitingDepartmentService::class, RecruitingDepartmentService::class);
        $this->app->bind(IRecruitingStepSubStepCheckService::class, RecruitingStepSubStepCheckService::class);
        $this->app->bind(IRecruitingEvaluationParameterService::class, RecruitingEvaluationParameterService::class);
        $this->app->bind(IPunishmentCategoryService::class, PunishmentCategoryService::class);
        $this->app->bind(IPunishmentService::class, PunishmentService::class);
        $this->app->bind(ITicketTransactionStatusService::class, TicketTransactionStatusService::class);

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

        // AwsServices
        $this->app->bind(IStorageService::class, StorageService::class);

        // MesajPaneliServices
        $this->app->bind(IMesajPaneliService::class, MesajPaneliService::class);
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
