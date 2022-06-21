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

    private $projectService;

    public function __construct(IProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function getByUserId(GetByUserIdRequest $request)
    {
        return $this->success('Projects', $this->projectService->getByProjectIds(
            $request->user()->projects()->pluck('id')->toArray()
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        if (!in_array($request->id, $userProjects)) {
            return $this->error('Project not found', 404);
        }

        return $this->success('Project', $this->projectService->getById($request->id));
    }

    public function getSubtasksByProjectId(GetSubtasksByProjectIdRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        if (!in_array($request->projectId, $userProjects)) {
            return $this->error('Project not found', 404);
        }

        return $this->success('Project sub tasks', $this->projectService->getSubtasksByProjectId($request->projectId));
    }

    public function getBoardsByProjectId(GetBoardsByProjectIdRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        if (!in_array($request->projectId, $userProjects)) {
            return $this->error('Project not found', 404);
        }

        return $this->success('Project boards', $this->projectService->getBoardsByProjectId(
            $request->projectId,
            $request->management
        ));
    }
}
