<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetDataScreeningRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetEmployeeGroupTasksEditRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetEmployeeGroupTasksRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetEmployeeTasksEditRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetEmployeeTasksRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetEmployeeWorkTasksEditRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetEmployeeWorkTasksRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetUserListRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetEmployeeEditRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetEmployeeGroupTasksInsertRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetEmployeeRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetEmployeeTasksInsertRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetEmployeeWorkTasksInsertRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetStaffParameterRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetStaffParameterEditRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetStaffParameterDeleteRequest;
use App\Interfaces\Eloquent\ICompanyService;
use App\Interfaces\OperationApi\IOperationService;
use App\Models\Eloquent\Employee;
use App\Traits\Response;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    use Response;

    /**
     * @var $operationService
     */
    private $operationService;

    /**
     * @var $companyService
     */
    private $companyService;

    /**
     * @param IOperationService $operationService
     * @param ICompanyService $companyService
     */
    public function __construct(
        IOperationService $operationService,
        ICompanyService   $companyService
    )
    {
        $this->operationService = $operationService;
        $this->companyService = $companyService;
    }

    /**
     * @param GetUserListRequest $request
     */
    public function getUserList(GetUserListRequest $request)
    {
        $getUserListResponse = $this->operationService->GetUserList($request->companyId);
        if ($getUserListResponse->isSuccess()) {
            return $this->success(
                $getUserListResponse->getMessage(),
                $getUserListResponse->getData(),
                $getUserListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getUserListResponse->getMessage(),
                $getUserListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetEmployeeEditRequest $request
     */
    public function getEmployeeEdit(GetEmployeeEditRequest $request)
    {
        $getEmployeeEditResponse = $this->operationService->GetEmployeeEdit($request->guid);
        if ($getEmployeeEditResponse->isSuccess()) {
            return $this->success(
                $getEmployeeEditResponse->getMessage(),
                $getEmployeeEditResponse->getData(),
                $getEmployeeEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeEditResponse->getMessage(),
                $getEmployeeEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetEmployeeTasksRequest $request
     */
    public function getEmployeeTasks(GetEmployeeTasksRequest $request)
    {
        $getEmployeeTasksResponse = $this->operationService->GetEmployeeTasks();
        if ($getEmployeeTasksResponse->isSuccess()) {
            return $this->success(
                $getEmployeeTasksResponse->getMessage(),
                $getEmployeeTasksResponse->getData(),
                $getEmployeeTasksResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeTasksResponse->getMessage(),
                $getEmployeeTasksResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetEmployeeTasksEditRequest $request
     */
    public function getEmployeeTasksEdit(GetEmployeeTasksEditRequest $request)
    {
        $getEmployeeTasksEditResponse = $this->operationService->GetEmployeeTasksEdit($request->guid);
        if ($getEmployeeTasksEditResponse->isSuccess()) {
            return $this->success(
                $getEmployeeTasksEditResponse->getMessage(),
                $getEmployeeTasksEditResponse->getData(),
                $getEmployeeTasksEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeTasksEditResponse->getMessage(),
                $getEmployeeTasksEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetEmployeeTasksInsertRequest $request
     */
    public function setEmployeeTasksInsert(SetEmployeeTasksInsertRequest $request)
    {
        $setEmployeeTasksInsertResponse = $this->operationService->SetEmployeeTasksInsert($request->guid, $request->tasks ?? []);
        if ($setEmployeeTasksInsertResponse->isSuccess()) {
            return $this->success(
                $setEmployeeTasksInsertResponse->getMessage(),
                $setEmployeeTasksInsertResponse->getData(),
                $setEmployeeTasksInsertResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setEmployeeTasksInsertResponse->getMessage(),
                $setEmployeeTasksInsertResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetEmployeeWorkTasksRequest $request
     */
    public function getEmployeeWorkTasks(GetEmployeeWorkTasksRequest $request)
    {
        $getEmployeeWorkTasksResponse = $this->operationService->GetEmployeeWorkTasks();
        if ($getEmployeeWorkTasksResponse->isSuccess()) {
            return $this->success(
                $getEmployeeWorkTasksResponse->getMessage(),
                $getEmployeeWorkTasksResponse->getData(),
                $getEmployeeWorkTasksResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeWorkTasksResponse->getMessage(),
                $getEmployeeWorkTasksResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetEmployeeWorkTasksEditRequest $request
     */
    public function getEmployeeWorkTasksEdit(GetEmployeeWorkTasksEditRequest $request)
    {
        $getEmployeeWorkTasksEditResponse = $this->operationService->GetEmployeeWorkTasksEdit($request->guid);
        if ($getEmployeeWorkTasksEditResponse->isSuccess()) {
            return $this->success(
                $getEmployeeWorkTasksEditResponse->getMessage(),
                $getEmployeeWorkTasksEditResponse->getData(),
                $getEmployeeWorkTasksEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeWorkTasksEditResponse->getMessage(),
                $getEmployeeWorkTasksEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetEmployeeWorkTasksInsertRequest $request
     */
    public function setEmployeeWorkTasksInsert(SetEmployeeWorkTasksInsertRequest $request)
    {
        $setEmployeeWorkTasksInsertResponse = $this->operationService->SetEmployeeWorkTasksInsert($request->guid, $request->workTasks ?? []);
        if ($setEmployeeWorkTasksInsertResponse->isSuccess()) {
            return $this->success(
                $setEmployeeWorkTasksInsertResponse->getMessage(),
                $setEmployeeWorkTasksInsertResponse->getData(),
                $setEmployeeWorkTasksInsertResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setEmployeeWorkTasksInsertResponse->getMessage(),
                $setEmployeeWorkTasksInsertResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetEmployeeGroupTasksRequest $request
     */
    public function getEmployeeGroupTasks(GetEmployeeGroupTasksRequest $request)
    {
        $getEmployeeGroupTasksResponse = $this->operationService->GetEmployeeGroupTasks();
        if ($getEmployeeGroupTasksResponse->isSuccess()) {
            return $this->success(
                $getEmployeeGroupTasksResponse->getMessage(),
                $getEmployeeGroupTasksResponse->getData(),
                $getEmployeeGroupTasksResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeGroupTasksResponse->getMessage(),
                $getEmployeeGroupTasksResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetEmployeeGroupTasksEditRequest $request
     */
    public function getEmployeeGroupTasksEdit(GetEmployeeGroupTasksEditRequest $request)
    {
        $getEmployeeGroupTasksEditResponse = $this->operationService->GetEmployeeGroupTasksEdit($request->guid);
        if ($getEmployeeGroupTasksEditResponse->isSuccess()) {
            return $this->success(
                $getEmployeeGroupTasksEditResponse->getMessage(),
                $getEmployeeGroupTasksEditResponse->getData(),
                $getEmployeeGroupTasksEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeGroupTasksEditResponse->getMessage(),
                $getEmployeeGroupTasksEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetEmployeeGroupTasksInsertRequest $request
     */
    public function setEmployeeGroupTasksInsert(SetEmployeeGroupTasksInsertRequest $request)
    {
        $setEmployeeGroupTasksInsertResponse = $this->operationService->SetEmployeeGroupTasksInsert($request->guid, $request->groupTasks);
        if ($setEmployeeGroupTasksInsertResponse->isSuccess()) {
            return $this->success(
                $setEmployeeGroupTasksInsertResponse->getMessage(),
                $setEmployeeGroupTasksInsertResponse->getData(),
                $setEmployeeGroupTasksInsertResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setEmployeeGroupTasksInsertResponse->getMessage(),
                $setEmployeeGroupTasksInsertResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetEmployeeRequest $request
     */
    public function setEmployee(SetEmployeeRequest $request)
    {
        $companyResponse = $this->companyService->getById($request->companyId);
        if ($companyResponse->isSuccess()) {
            $username = $request->username;
            $checkUsername = Employee::where('email', 'like', "{$request->username}@%")->first();

            if ($checkUsername) {
                return $this->error('Bu kullanıcı adı zaten kullanımda. Lütfen farklı bir kullanıcı adı giriniz.', 400);
            }

            $setEmployeeResponse = $this->operationService->SetEmployee(
                $request->id,
                $request->companyId,
                $request->email,
                $request->username,
                $request->password,
                $request->name,
                $request->assignment,
                $request->education,
                $request->webCrmUserId,
                $request->webCrmUsername,
                $request->webCrmUserPassword,
                $request->progressCrmUsername,
                $request->progressCrmPassword,
                $request->marketingCrmUsername,
                $request->marketingCrmPassword,
                $request->activeJobDescription,
                $companyResponse->getData()->uyum_crm_company_id,
                $companyResponse->getData()->uyum_crm_branch_id,
                $companyResponse->getData()->uyum_crm_branch_code,
                $companyResponse->getData()->active_year,
                $request->role,
                $request->groupCode,
                $request->teamCode,
                $request->teamLead,
                $request->teamLeadAssistant,
                $request->callScanCode,
                $request->santralCode,
                $request->tasks ?? [],
                $request->workTasks ?? [],
                $request->uyumSatisApiCrmUserName,
                $request->uyumSatisApiCrmUserPassword
            );
            if ($setEmployeeResponse->isSuccess()) {
                return $this->success(
                    $setEmployeeResponse->getMessage(),
                    $setEmployeeResponse->getData(),
                    $setEmployeeResponse->getStatusCode()
                );
            } else {
                return $this->error(
                    $setEmployeeResponse->getMessage(),
                    $setEmployeeResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $companyResponse->getMessage(),
                $companyResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetDataScreeningRequest $request
     */
    public function getDataScreening(GetDataScreeningRequest $request)
    {
        $getDataScreeningResponse = $this->operationService->GetDataScreening(
            $request->startDate,
            $request->endDate
        );
        if ($getDataScreeningResponse->isSuccess()) {
            return $this->success(
                $getDataScreeningResponse->getMessage(),
                $getDataScreeningResponse->getData(),
                $getDataScreeningResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDataScreeningResponse->getMessage(),
                $getDataScreeningResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetStaffParameterRequest $request
     */
    public function setStaffParameter(SetStaffParameterRequest $request)
    {
        $setStaffParameterResponse = $this->operationService->SetStaffParameter(
            $request->staffParameters
        );
        if ($setStaffParameterResponse->isSuccess()) {
            return $this->success(
                $setStaffParameterResponse->getMessage(),
                $setStaffParameterResponse->getData(),
                $setStaffParameterResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setStaffParameterResponse->getMessage(),
                $setStaffParameterResponse->getStatusCode()
            );
        }
    }

    /**
     * @param Request $request
     */
    public function setStaffParameterByCompanyId(Request $request)
    {
        $setStaffParameterResponse = $this->operationService->SetStaffParameterByCompanyId(
            $request->companyIds,
            $request->startDate,
            $request->endDate,
        );
        if ($setStaffParameterResponse->isSuccess()) {
            return $this->success(
                $setStaffParameterResponse->getMessage(),
                $setStaffParameterResponse->getData(),
                $setStaffParameterResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setStaffParameterResponse->getMessage(),
                $setStaffParameterResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetStaffParameterEditRequest $request
     */
    public function getStaffParameterEdit(GetStaffParameterEditRequest $request)
    {
        $setStaffParameterResponse = $this->operationService->GetStaffParameterEdit(
            $request->shiftId
        );
        if ($setStaffParameterResponse->isSuccess()) {
            return $this->success(
                $setStaffParameterResponse->getMessage(),
                $setStaffParameterResponse->getData(),
                $setStaffParameterResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setStaffParameterResponse->getMessage(),
                $setStaffParameterResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetStaffParameterDeleteRequest $request
     */
    public function setStaffParameterDelete(SetStaffParameterDeleteRequest $request)
    {
        $setStaffParameterResponse = $this->operationService->SetStaffParameterDelete(
            $request->shiftId
        );
        if ($setStaffParameterResponse->isSuccess()) {
            return $this->success(
                $setStaffParameterResponse->getMessage(),
                $setStaffParameterResponse->getData(),
                $setStaffParameterResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setStaffParameterResponse->getMessage(),
                $setStaffParameterResponse->getStatusCode()
            );
        }
    }
}
