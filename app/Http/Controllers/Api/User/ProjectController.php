<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IProjectService;
use App\Http\Requests\Api\User\ProjectController\GetByUserIdRequest;
use App\Http\Requests\Api\User\ProjectController\GetAllRequest;
use App\Http\Requests\Api\User\ProjectController\GetByIdRequest;
use App\Http\Requests\Api\User\ProjectController\GetAllTasksRequest;
use App\Http\Requests\Api\User\ProjectController\GetSubtasksByProjectIdRequest;
use App\Http\Requests\Api\User\ProjectController\GetBoardsByProjectIdRequest;
use App\Http\Requests\Api\User\ProjectController\GetUsersByProjectIdRequest;
use App\Http\Requests\Api\User\ProjectController\SetUsersByProjectIdRequest;
use App\Http\Requests\Api\User\ProjectController\CreateRequest;
use App\Http\Requests\Api\User\ProjectController\UpdateRequest;
use App\Http\Requests\Api\User\ProjectController\DeleteRequest;
use App\Traits\Response;

class ProjectController extends Controller
{
    use Response;

    /**
     * @var $projectService
     */
    private $projectService;

    /**
     * @param IProjectService $projectService
     */
    public function __construct(IProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @param GetByUserIdRequest $request
     */
    public function getByUserId(GetByUserIdRequest $request)
    {
        $getByUserIdResponse = $this->projectService->getByProjectIds(
            $request->user()->projects()->pluck('id')->toArray(),
            $request->statusIds,
            $request->keyword,
            $request->ticketStatusIds
        );
        if ($getByUserIdResponse->isSuccess()) {
            return $this->success(
                $getByUserIdResponse->getMessage(),
                $getByUserIdResponse->getData(),
                $getByUserIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByUserIdResponse->getMessage(),
                $getByUserIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->projectService->getAll();
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

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        if (!in_array($request->id, $userProjects)) {
            return $this->error('Project not found', 404);
        }

        $getByIdResponse = $this->projectService->getById($request->id);
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
     * @param GetAllTasksRequest $request
     */
    public function getAllTasks(GetAllTasksRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        if (!in_array($request->projectId, $userProjects)) {
            return $this->error('Project not found', 404);
        }

        $getAllTasksResponse = $this->projectService->getAllTasks(
            $request->projectId,
            $request->management
        );
        if ($getAllTasksResponse->isSuccess()) {
            return $this->success(
                $getAllTasksResponse->getMessage(),
                $getAllTasksResponse->getData(),
                $getAllTasksResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllTasksResponse->getMessage(),
                $getAllTasksResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSubtasksByProjectIdRequest $request
     */
    public function getSubtasksByProjectId(GetSubtasksByProjectIdRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        if (!in_array($request->projectId, $userProjects)) {
            return $this->error('Project not found', 404);
        }

        $getSubtasksByProjectIdResponse = $this->projectService->getSubtasksByProjectId($request->projectId);
        if ($getSubtasksByProjectIdResponse->isSuccess()) {
            return $this->success(
                $getSubtasksByProjectIdResponse->getMessage(),
                $getSubtasksByProjectIdResponse->getData(),
                $getSubtasksByProjectIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSubtasksByProjectIdResponse->getMessage(),
                $getSubtasksByProjectIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetBoardsByProjectIdRequest $request
     */
    public function getBoardsByProjectId(GetBoardsByProjectIdRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        if (!in_array($request->projectId, $userProjects)) {
            return $this->error('Project not found', 404);
        }

        $getBoardsByProjectIdResponse = $this->projectService->getBoardsByProjectId(
            $request->projectId,
            $request->management
        );
        if ($getBoardsByProjectIdResponse->isSuccess()) {
            return $this->success(
                $getBoardsByProjectIdResponse->getMessage(),
                $getBoardsByProjectIdResponse->getData(),
                $getBoardsByProjectIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getBoardsByProjectIdResponse->getMessage(),
                $getBoardsByProjectIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetUsersByProjectIdRequest $request
     */
    public function getUsersByProjectId(GetUsersByProjectIdRequest $request)
    {
        $getUsersByProjectIdResponse = $this->projectService->getUsersByProjectId(
            $request->projectId
        );
        if ($getUsersByProjectIdResponse->isSuccess()) {
            return $this->success(
                $getUsersByProjectIdResponse->getMessage(),
                $getUsersByProjectIdResponse->getData(),
                $getUsersByProjectIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getUsersByProjectIdResponse->getMessage(),
                $getUsersByProjectIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetUsersByProjectIdRequest $request
     */
    public function setUsersByProjectId(SetUsersByProjectIdRequest $request)
    {
        $setUsersByProjectIdResponse = $this->projectService->setUsersByProjectId(
            $request->projectId,
            $request->userIds
        );
        if ($setUsersByProjectIdResponse->isSuccess()) {
            return $this->success(
                $setUsersByProjectIdResponse->getMessage(),
                $setUsersByProjectIdResponse->getData(),
                $setUsersByProjectIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setUsersByProjectIdResponse->getMessage(),
                $setUsersByProjectIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->projectService->create(
            $request->companyId,
            $request->name,
            $request->code,
            $request->startDate,
            $request->endDate,
            $request->description
        );
        if ($createResponse->isSuccess()) {
            return $this->success(
                $createResponse->getMessage(),
                $createResponse->getData(),
                $createResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->projectService->update(
            $request->id,
            $request->companyId,
            $request->statusId,
            $request->name,
            $request->code,
            $request->startDate,
            $request->endDate,
            $request->description
        );
        if ($updateResponse->isSuccess()) {
            return $this->success(
                $updateResponse->getMessage(),
                $updateResponse->getData(),
                $updateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->projectService->delete(
            $request->id
        );
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
