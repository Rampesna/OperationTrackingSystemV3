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
use App\Interfaces\OperationApi\IOperationService;
use App\Traits\Response;

class OperationController extends Controller
{
    use Response;

    private $operationService;

    public function __construct(IOperationService $operationService)
    {
        $this->operationService = $operationService;
    }

    public function getUserList(GetUserListRequest $request)
    {
        return $this->success('Operation users', $this->operationService->GetUserList($request->companyId));
    }

    public function getEmployeeTasks(GetEmployeeTasksRequest $request)
    {
        return $this->success('Employee tasks', $this->operationService->GetEmployeeTasks());
    }

    public function getEmployeeTasksEdit(GetEmployeeTasksEditRequest $request)
    {
        return $this->success('Employee tasks edit', $this->operationService->GetEmployeeTasksEdit($request->guid));
    }

    public function setEmployeeTasksInsert(SetEmployeeTasksInsertRequest $request)
    {
        return $this->success('Employee tasks updated', $this->operationService->SetEmployeeTasksInsert($request->guid, $request->tasks));
    }

    public function getEmployeeWorkTasks(GetEmployeeWorkTasksRequest $request)
    {
        return $this->success('Employee work tasks', $this->operationService->GetEmployeeWorkTasks());
    }

    public function getEmployeeWorkTasksEdit(GetEmployeeWorkTasksEditRequest $request)
    {
        return $this->success('Employee work tasks edit', $this->operationService->GetEmployeeWorkTasksEdit($request->guid));
    }

    public function setEmployeeWorkTasksInsert(SetEmployeeWorkTasksInsertRequest $request)
    {
        return $this->success('Employee work tasks updated', $this->operationService->SetEmployeeWorkTasksInsert($request->guid, $request->workTasks));
    }

    public function getEmployeeGroupTasks(GetEmployeeGroupTasksRequest $request)
    {
        return $this->success('Employee group tasks', $this->operationService->GetEmployeeGroupTasks());
    }

    public function getEmployeeGroupTasksEdit(GetEmployeeGroupTasksEditRequest $request)
    {
        return $this->success('Employee group tasks edit', $this->operationService->GetEmployeeGroupTasksEdit($request->guid));
    }

    public function setEmployeeGroupTasksInsert(SetEmployeeGroupTasksInsertRequest $request)
    {
        return $this->success('Employee group tasks updated', $this->operationService->SetEmployeeGroupTasksInsert($request->guid, $request->groupTasks));
    }

    public function setEmployee(SetEmployeeRequest $request)
    {
        return $this->success('Employee group tasks updated', $this->operationService->SetEmployee(
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
        ));
    }

    public function getDataScreening(GetDataScreeningRequest $request)
    {
        return $this->success('Data screening', $this->operationService->GetDataScreening(
            $request->startDate,
            $request->endDate
        ));
    }

    public function setStaffParameter(SetStaffParameterRequest $request)
    {
        return $this->success('Set staff parameter', $this->operationService->SetStaffParameter(
            $request->staffParameters
        ));
    }
}
