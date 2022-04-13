<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationController\GetUserListRequest;
use App\Http\Requests\Api\User\OperationController\GetEmployeeTasksRequest;
use App\Http\Requests\Api\User\OperationController\GetEmployeeWorkTasksRequest;
use App\Http\Requests\Api\User\OperationController\GetEmployeeGroupTasksRequest;
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

    public function getEmployeeWorkTasks(GetEmployeeWorkTasksRequest $request)
    {
        return $this->success('Employee work tasks', $this->operationService->GetEmployeeWorkTasks());
    }

    public function getEmployeeGroupTasks(GetEmployeeGroupTasksRequest $request)
    {
        return $this->success('Employee group tasks', $this->operationService->GetEmployeeGroupTasks());
    }
}
