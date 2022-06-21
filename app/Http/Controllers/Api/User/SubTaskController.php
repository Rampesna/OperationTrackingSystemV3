<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ISubTaskService;
use App\Http\Requests\Api\User\SubTaskController\GetByProjectIdRequest;
use App\Http\Requests\Api\User\SubTaskController\GetByProjectIdsRequest;
use App\Traits\Response;

class SubTaskController extends Controller
{
    use Response;

    private $subTaskService;

    public function __construct(ISubTaskService $subTaskService)
    {
        $this->subTaskService = $subTaskService;
    }

    public function getByProjectId(GetByProjectIdRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        if (!in_array($request->projectId, $userProjects)) {
            return $this->error('Project not found', 404);
        }

        return $this->success('Project sub tasks', $this->subTaskService->getByProjectId($request->projectId));
    }

    public function getByProjectIds(GetByProjectIdsRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        foreach ($request->projectIds as $projectId) {
            if (!in_array($projectId, $userProjects)) {
                return $this->error('Project not found', 404);
            }
        }

        return $this->success('Project sub tasks', $this->subTaskService->getByProjectIds($request->projectIds));
    }
}
