<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EmployeeQueueController\GetEmployeeQueuesRequest;
use App\Http\Requests\Api\User\EmployeeQueueController\GetQueueEmployeesRequest;
use App\Http\Requests\Api\User\EmployeeQueueController\SetEmployeeQueuesRequest;
use App\Http\Requests\Api\User\EmployeeQueueController\SetQueueEmployeesRequest;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IQueueService;
use App\Traits\Response;

class EmployeeQueueController extends Controller
{
    use Response;

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @var $queueService
     */
    private $queueService;

    /**
     * @param IEmployeeService $employeeService
     * @param IQueueService $queueService
     */
    public function __construct(
        IEmployeeService $employeeService,
        IQueueService    $queueService
    )
    {
        $this->employeeService = $employeeService;
        $this->queueService = $queueService;
    }

    /**
     * @param GetEmployeeQueuesRequest $request
     */
    public function getEmployeeQueues(GetEmployeeQueuesRequest $request)
    {
        $getEmployeeQueuesResponse = $this->employeeService->getEmployeeQueues($request->employeeId);
        if ($getEmployeeQueuesResponse->isSuccess()) {
            return $this->success(
                $getEmployeeQueuesResponse->getMessage(),
                $getEmployeeQueuesResponse->getData(),
                $getEmployeeQueuesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getEmployeeQueuesResponse->getMessage(),
                $getEmployeeQueuesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetEmployeeQueuesRequest $request
     */
    public function setEmployeeQueues(SetEmployeeQueuesRequest $request)
    {
        $setEmployeeQueuesResponse = $this->employeeService->setEmployeeQueues($request->employeeId, $request->queueIds);
        if ($setEmployeeQueuesResponse->isSuccess()) {
            return $this->success(
                $setEmployeeQueuesResponse->getMessage(),
                $setEmployeeQueuesResponse->getData(),
                $setEmployeeQueuesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setEmployeeQueuesResponse->getMessage(),
                $setEmployeeQueuesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetQueueEmployeesRequest $request
     */
    public function getQueueEmployees(GetQueueEmployeesRequest $request)
    {
        $getQueueEmployeesResponse = $this->queueService->getQueueEmployees($request->queueId);
        if ($getQueueEmployeesResponse->isSuccess()) {
            return $this->success(
                $getQueueEmployeesResponse->getMessage(),
                $getQueueEmployeesResponse->getData(),
                $getQueueEmployeesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getQueueEmployeesResponse->getMessage(),
                $getQueueEmployeesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetQueueEmployeesRequest $request
     */
    public function setQueueEmployees(SetQueueEmployeesRequest $request)
    {
        $setQueueEmployeesResponse = $this->queueService->setQueueEmployees($request->queueId, $request->employeeIds);
        if ($setQueueEmployeesResponse->isSuccess()) {
            return $this->success(
                $setQueueEmployeesResponse->getMessage(),
                $setQueueEmployeesResponse->getData(),
                $setQueueEmployeesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setQueueEmployeesResponse->getMessage(),
                $setQueueEmployeesResponse->getStatusCode()
            );
        }
    }
}

