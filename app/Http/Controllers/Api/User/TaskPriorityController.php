<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ITaskPriorityService;
use App\Http\Requests\Api\User\TaskPriorityController\GetAllRequest;
use App\Traits\Response;

class TaskPriorityController extends Controller
{
    use Response;

    /**
     * @var $taskPriorityService
     */
    private $taskPriorityService;

    /**
     * @param ITaskPriorityService $taskPriorityService
     */
    public function __construct(ITaskPriorityService $taskPriorityService)
    {
        $this->taskPriorityService = $taskPriorityService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->taskPriorityService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }
}
