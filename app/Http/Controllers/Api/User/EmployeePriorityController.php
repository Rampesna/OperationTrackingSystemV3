<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IPriorityService;
use App\Http\Requests\Api\User\EmployeePriorityController\GetEmployeePrioritiesRequest;
use App\Http\Requests\Api\User\EmployeePriorityController\SetEmployeePrioritiesRequest;
use App\Http\Requests\Api\User\EmployeePriorityController\GetPriorityEmployeesRequest;
use App\Http\Requests\Api\User\EmployeePriorityController\SetPriorityEmployeesRequest;
use App\Traits\Response;

class EmployeePriorityController extends Controller
{
    use Response;

    private $employeeService;
    private $priorityService;

    public function __construct(IEmployeeService $employeeService, IPriorityService $priorityService)
    {
        $this->employeeService = $employeeService;
        $this->priorityService = $priorityService;
    }

    public function getEmployeePriorities(GetEmployeePrioritiesRequest $request)
    {
        return $this->success('Employee priorities', $this->employeeService->getEmployeePriorities($request->employeeId));
    }

    public function setEmployeePriorities(SetEmployeePrioritiesRequest $request)
    {
        return $this->success('Employee priorities updated', $this->employeeService->setEmployeePriorities($request->employeeId, $request->priorityIds));
    }

    public function getPriorityEmployees(GetPriorityEmployeesRequest $request)
    {
        return $this->success('Priority employees', $this->priorityService->getPriorityEmployees($request->priorityId));
    }

    public function setPriorityEmployees(SetPriorityEmployeesRequest $request)
    {
        return $this->success('Priority employees updated', $this->priorityService->setPriorityEmployees($request->priorityId, $request->employeeIds));
    }
}

