<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\TaskController\GetByIdRequest;
use App\Http\Requests\Api\User\TaskController\GetFilesByIdRequest;
use App\Http\Requests\Api\User\TaskController\GetSubTasksByIdRequest;
use App\Http\Requests\Api\User\TaskController\GetCommentsByIdRequest;
use App\Http\Requests\Api\User\TaskController\UpdateBoardRequest;
use App\Http\Requests\Api\User\TaskController\UpdateOrderRequest;
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

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Task', $this->taskService->getById($request->id));
    }

    public function getFilesById(GetFilesByIdRequest $request)
    {
        return $this->success('Task files', $this->taskService->getFilesById($request->id));
    }

    public function getSubTasksById(GetSubTasksByIdRequest $request)
    {
        return $this->success('Task sub tasks', $this->taskService->getSubTasksById($request->id));
    }

    public function getCommentsById(GetCommentsByIdRequest $request)
    {
        return $this->success('Task comments', $this->taskService->getCommentsById($request->id));
    }

    public function updateBoard(UpdateBoardRequest $request)
    {
        return $this->success('Task', $this->taskService->updateBoard(
            $request->taskId,
            $request->boardId
        ));
    }

    public function updateOrder(UpdateOrderRequest $request)
    {
        return $this->success('Task', $this->taskService->updateOrder(
            $request->tasks
        ));
    }
}
