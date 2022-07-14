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

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @var $shiftGroupService
     */
    private $shiftGroupService;

    /**
     * @param IEmployeeService $employeeService
     * @param IShiftGroupService $shiftGroupService
     */
    public function __construct(
        IEmployeeService   $employeeService,
        IShiftGroupService $shiftGroupService
    )
    {
        $this->employeeService = $employeeService;
        $this->shiftGroupService = $shiftGroupService;
    }

    /**
     * @param GetEmployeeShiftGroupsRequest $request
     */
    public function getEmployeeShiftGroups(GetEmployeeShiftGroupsRequest $request)
    {
        $getEmployeeShiftGroupsResponse = $this->employeeService->getEmployeeShiftGroups($request->employeeId);
        if ($getEmployeeShiftGroupsResponse->isSuccess()) {
            return $this->success(
                $getEmployeeShiftGroupsResponse->getMessage(),
                $getEmployeeShiftGroupsResponse->getData(),
                $getEmployeeShiftGroupsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeShiftGroupsResponse->getMessage(),
                $getEmployeeShiftGroupsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetEmployeeShiftGroupsRequest $request
     */
    public function setEmployeeShiftGroups(SetEmployeeShiftGroupsRequest $request)
    {
        $setEmployeeShiftGroupsResponse = $this->employeeService->setEmployeeShiftGroups($request->employeeId, $request->shiftGroupIds);
        if ($setEmployeeShiftGroupsResponse->isSuccess()) {
            return $this->success(
                $setEmployeeShiftGroupsResponse->getMessage(),
                $setEmployeeShiftGroupsResponse->getData(),
                $setEmployeeShiftGroupsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setEmployeeShiftGroupsResponse->getMessage(),
                $setEmployeeShiftGroupsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetShiftGroupEmployeesRequest $request
     */
    public function getShiftGroupEmployees(GetShiftGroupEmployeesRequest $request)
    {
        $getShiftGroupEmployeesResponse = $this->shiftGroupService->getShiftGroupEmployees($request->shiftGroupId);
        if ($getShiftGroupEmployeesResponse->isSuccess()) {
            return $this->success(
                $getShiftGroupEmployeesResponse->getMessage(),
                $getShiftGroupEmployeesResponse->getData(),
                $getShiftGroupEmployeesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getShiftGroupEmployeesResponse->getMessage(),
                $getShiftGroupEmployeesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetShiftGroupEmployeesRequest $request
     */
    public function setShiftGroupEmployees(SetShiftGroupEmployeesRequest $request)
    {
        $setShiftGroupEmployeesResponse = $this->shiftGroupService->setShiftGroupEmployees($request->shiftGroupId, $request->employeeIds);
        if ($setShiftGroupEmployeesResponse->isSuccess()) {
            return $this->success(
                $setShiftGroupEmployeesResponse->getMessage(),
                $setShiftGroupEmployeesResponse->getData(),
                $setShiftGroupEmployeesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setShiftGroupEmployeesResponse->getMessage(),
                $setShiftGroupEmployeesResponse->getStatusCode()
            );
        }
    }
}

