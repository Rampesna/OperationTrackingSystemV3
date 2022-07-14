<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\TaskController\GetByIdRequest;
use App\Http\Requests\Api\User\TaskController\GetFilesByIdRequest;
use App\Http\Requests\Api\User\TaskController\GetSubTasksByIdRequest;
use App\Http\Requests\Api\User\TaskController\GetCommentsByIdRequest;
use App\Http\Requests\Api\User\TaskController\UpdateBoardRequest;
use App\Http\Requests\Api\User\TaskController\UpdateOrderRequest;
use App\Http\Requests\Api\User\TaskController\UpdateByParametersRequest;
use App\Http\Requests\Api\User\TaskController\DeleteRequest;
use App\Interfaces\Eloquent\ITaskService;
use App\Traits\Response;

class TaskController extends Controller
{
    use Response;

    /**
     * @var $taskService
     */
    private $taskService;

    /**
     * @param ITaskService $taskService
     */
    public function __construct(ITaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->taskService->getById($request->id);
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetFilesByIdRequest $request
     */
    public function getFilesById(GetFilesByIdRequest $request)
    {
        $getFilesByIdResponse = $this->taskService->getFilesById($request->id);
        if ($getFilesByIdResponse->isSuccess()) {
            return $this->success(
                $getFilesByIdResponse->getMessage(),
                $getFilesByIdResponse->getData(),
                $getFilesByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getFilesByIdResponse->getMessage(),
                $getFilesByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSubTasksByIdRequest $request
     */
    public function getSubTasksById(GetSubTasksByIdRequest $request)
    {
        $getSubTasksByIdResponse = $this->taskService->getSubTasksById($request->id);
        if ($getSubTasksByIdResponse->isSuccess()) {
            return $this->success(
                $getSubTasksByIdResponse->getMessage(),
                $getSubTasksByIdResponse->getData(),
                $getSubTasksByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSubTasksByIdResponse->getMessage(),
                $getSubTasksByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetCommentsByIdRequest $request
     */
    public function getCommentsById(GetCommentsByIdRequest $request)
    {
        $getCommentsByIdResponse = $this->taskService->getCommentsById($request->id);
        if ($getCommentsByIdResponse->isSuccess()) {
            return $this->success(
                $getCommentsByIdResponse->getMessage(),
                $getCommentsByIdResponse->getData(),
                $getCommentsByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getCommentsByIdResponse->getMessage(),
                $getCommentsByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateBoardRequest $request
     */
    public function updateBoard(UpdateBoardRequest $request)
    {
        $updateBoardResponse = $this->taskService->updateBoard(
            $request->taskId,
            $request->boardId
        );
        if ($updateBoardResponse->isSuccess()) {
            return $this->success(
                $updateBoardResponse->getMessage(),
                $updateBoardResponse->getData(),
                $updateBoardResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateBoardResponse->getMessage(),
                $updateBoardResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateOrderRequest $request
     */
    public function updateOrder(UpdateOrderRequest $request)
    {
        $updateOrderResponse = $this->taskService->updateOrder(
            $request->tasks
        );
        if ($updateOrderResponse->isSuccess()) {
            return $this->success(
                $updateOrderResponse->getMessage(),
                $updateOrderResponse->getData(),
                $updateOrderResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateOrderResponse->getMessage(),
                $updateOrderResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateByParametersRequest $request
     */
    public function updateByParameters(UpdateByParametersRequest $request)
    {
        $updateByParametersResponse = $this->taskService->updateByParameters(
            $request->id,
            $request->parameters
        );
        if ($updateByParametersResponse->isSuccess()) {
            return $this->success(
                $updateByParametersResponse->getMessage(),
                $updateByParametersResponse->getData(),
                $updateByParametersResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateByParametersResponse->getMessage(),
                $updateByParametersResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->taskService->delete($request->id);
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
