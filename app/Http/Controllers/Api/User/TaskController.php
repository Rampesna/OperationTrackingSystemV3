<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\TaskController\UpdateBoardRequest;
use App\Interfaces\Eloquent\ITaskService;
use App\Traits\Response;

class TaskController extends Controller
{
    use Response;

    private $taskService;

    public function __construct(ITaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function updateBoard(UpdateBoardRequest $request)
    {
        return $this->success('Task', $this->taskService->updateBoard(
            $request->taskId,
            $request->boardId
        ));
    }
}
