<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IProjectService;
use App\Http\Requests\Api\User\ProjectController\GetByUserIdRequest;
use App\Http\Requests\Api\User\ProjectController\GetByIdRequest;
use App\Http\Requests\Api\User\ProjectController\GetSubtasksByProjectIdRequest;
use App\Http\Requests\Api\User\ProjectController\GetBoardsByProjectIdRequest;
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
            $request->user()->projects()->pluck('id')->toArray()
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
}
