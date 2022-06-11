<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EmployeeShiftGroupController\GetEmployeeShiftGroupsRequest;
use App\Http\Requests\Api\User\EmployeeShiftGroupController\GetShiftGroupEmployeesRequest;
use App\Http\Requests\Api\User\EmployeeShiftGroupController\SetEmployeeShiftGroupsRequest;
use App\Http\Requests\Api\User\EmployeeShiftGroupController\SetShiftGroupEmployeesRequest;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Traits\Response;

class EmployeeShiftGroupController extends Controller
{
    use Response;

    private $employeeService;
    private $shiftGroupService;

    public function __construct(IEmployeeService $employeeService, IShiftGroupService $shiftGroupService)
    {
        $this->employeeService = $employeeService;
        $this->shiftGroupService = $shiftGroupService;
    }

    public function getEmployeeShiftGroups(GetEmployeeShiftGroupsRequest $request)
    {
        return $this->success('Employee shiftGroups', $this->employeeService->getEmployeeShiftGroups($request->employeeId));
    }

    public function setEmployeeShiftGroups(SetEmployeeShiftGroupsRequest $request)
    {
        return $this->success('Employee shiftGroups updated', $this->employeeService->setEmployeeShiftGroups($request->employeeId, $request->shiftGroupIds));
    }

    public function getShiftGroupEmployees(GetShiftGroupEmployeesRequest $request)
    {
        return $this->success('ShiftGroup employees', $this->shiftGroupService->getShiftGroupEmployees($request->shiftGroupId));
    }

    public function setShiftGroupEmployees(SetShiftGroupEmployeesRequest $request)
    {
        return $this->success('ShiftGroup employees updated', $this->shiftGroupService->setShiftGroupEmployees($request->shiftGroupId, $request->employeeIds));
    }
}

