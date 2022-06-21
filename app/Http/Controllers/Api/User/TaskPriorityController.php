<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ITaskPriorityService;
use App\Http\Requests\Api\User\TaskPriorityController\GetAllRequest;
use App\Traits\Response;

class TaskPriorityController extends Controller
{
    use Response;

    private $taskPriorityService;

    public function __construct(ITaskPriorityService $taskPriorityService)
    {
        $this->taskPriorityService = $taskPriorityService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('Task priorities', $this->taskPriorityService->getAll());
    }
}
