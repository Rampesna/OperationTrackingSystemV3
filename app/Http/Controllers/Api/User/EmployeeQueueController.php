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

    private $employeeService;
    private $queueService;

    public function __construct(IEmployeeService $employeeService, IQueueService $queueService)
    {
        $this->employeeService = $employeeService;
        $this->queueService = $queueService;
    }

    public function getEmployeeQueues(GetEmployeeQueuesRequest $request)
    {
        return $this->success('Employee queues', $this->employeeService->getEmployeeQueues($request->employeeId));
    }

    public function setEmployeeQueues(SetEmployeeQueuesRequest $request)
    {
        return $this->success('Employee queues updated', $this->employeeService->setEmployeeQueues($request->employeeId, $request->queueIds));
    }

    public function getQueueEmployees(GetQueueEmployeesRequest $request)
    {
        return $this->success('Queue employees', $this->queueService->getQueueEmployees($request->queueId));
    }

    public function setQueueEmployees(SetQueueEmployeesRequest $request)
    {
        return $this->success('Queue employees updated', $this->queueService->setQueueEmployees($request->queueId, $request->employeeIds));
    }
}

