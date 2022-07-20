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
use App\Http\Requests\Api\User\OperationApi\OperationController\SetEmployeeGroupTasksInsertRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetEmployeeRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetEmployeeTasksInsertRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetEmployeeWorkTasksInsertRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\SetStaffParameterRequest;
use App\Http\Requests\Api\User\OperationApi\OperationController\GetStaffParameterEditRequest;
use App\Interfaces\OperationApi\IOperationService;
use App\Traits\Response;

class OperationController extends Controller
{
    use Response;

    /**
     * @var $operationService
     */
    private $operationService;

    /**
     * @param IOperationService $operationService
     */
    public function __construct(IOperationService $operationService)
    {
        $this->operationService = $operationService;
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
        $setEmployeeTasksInsertResponse = $this->operationService->SetEmployeeTasksInsert($request->guid, $request->tasks);
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
        $setEmployeeWorkTasksInsertResponse = $this->operationService->SetEmployeeWorkTasksInsert($request->guid, $request->workTasks);
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
            $request->webCrmUserName,
            $request->webCrmUserPassword,
            $request->progressCrmUsername,
            $request->progressCrmPassword,
            $request->activeJobDescription,
            $request->role,
            $request->groupCode,
            $request->teamCode,
            $request->teamLead,
            $request->teamLeadAssistant,
            $request->callScanCode,
            $request->santralCode,
            $request->tasks,
            $request->workTasks
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
}
