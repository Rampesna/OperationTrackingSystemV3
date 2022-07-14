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

    /**
     * @var $subTaskService
     */
    private $subTaskService;

    /**
     * @param ISubTaskService $subTaskService
     */
    public function __construct(ISubTaskService $subTaskService)
    {
        $this->subTaskService = $subTaskService;
    }

    /**
     * @param GetByProjectIdRequest $request
     */
    public function getByProjectId(GetByProjectIdRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        if (!in_array($request->projectId, $userProjects)) {
            return $this->error('Project not found', 404);
        }

        $getByProjectIdResponse = $this->subTaskService->getByProjectId($request->projectId);
        if ($getByProjectIdResponse->isSuccess()) {
            return $this->success(
                $getByProjectIdResponse->getMessage(),
                $getByProjectIdResponse->getData(),
                $getByProjectIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByProjectIdResponse->getMessage(),
                $getByProjectIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByProjectIdsRequest $request
     */
    public function getByProjectIds(GetByProjectIdsRequest $request)
    {
        $userProjects = $request->user()->projects()->pluck('id')->toArray();

        foreach ($request->projectIds as $projectId) {
            if (!in_array($projectId, $userProjects)) {
                return $this->error('Project not found', 404);
            }
        }

        $getByProjectIdsResponse = $this->subTaskService->getByProjectIds($request->projectIds);
        if ($getByProjectIdsResponse->isSuccess()) {
            return $this->success(
                $getByProjectIdsResponse->getMessage(),
                $getByProjectIdsResponse->getData(),
                $getByProjectIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByProjectIdsResponse->getMessage(),
                $getByProjectIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->subTaskService->create(
            $request->taskId,
            $request->name
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
        $updateResponse = $this->subTaskService->update(
            $request->id,
            $request->name
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
     * @param SetCheckedRequest $request
     */
    public function setChecked(SetCheckedRequest $request)
    {
        $setCheckedResponse = $this->subTaskService->setChecked(
            $request->id,
            $request->checked
        );
        if ($setCheckedResponse->isSuccess()) {
            return $this->success(
                $setCheckedResponse->getMessage(),
                $setCheckedResponse->getData(),
                $setCheckedResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setCheckedResponse->getMessage(),
                $setCheckedResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->subTaskService->delete(
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
