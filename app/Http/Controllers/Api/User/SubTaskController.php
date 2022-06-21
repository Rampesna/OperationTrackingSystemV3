<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ISubTaskService;
use App\Http\Requests\Api\User\SubTaskController\GetByProjectIdRequest;
use App\Http\Requests\Api\User\SubTaskController\GetByProjectIdsRequest;
use App\Http\Requests\Api\User\SubTaskController\CreateRequest;
use App\Http\Requests\Api\User\SubTaskController\UpdateRequest;
use App\Http\Requests\Api\User\SubTaskController\SetCheckedRequest;
use App\Http\Requests\Api\User\SubTaskController\DeleteRequest;
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

    public function create(CreateRequest $request)
    {
        return $this->success('Project sub task', $this->subTaskService->create(
            $request->taskId,
            $request->name
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('Project sub task', $this->subTaskService->update(
            $request->id,
            $request->name
        ));
    }

    public function setChecked(SetCheckedRequest $request)
    {
        return $this->success('Project sub task', $this->subTaskService->setChecked(
            $request->id,
            $request->checked
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('Project sub task deleted', $this->subTaskService->delete(
            $request->id
        ));
    }
}
