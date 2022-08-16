<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ProjectVersionController\GetByProjectIdRequest;
use App\Http\Requests\Api\User\ProjectVersionController\GetByIdRequest;
use App\Http\Requests\Api\User\ProjectVersionController\CreateRequest;
use App\Http\Requests\Api\User\ProjectVersionController\UpdateRequest;
use App\Http\Requests\Api\User\ProjectVersionController\DeleteRequest;
use App\Interfaces\Eloquent\IProjectVersionService;
use App\Traits\Response;

class ProjectVersionController extends Controller
{
    use Response;

    /**
     * @var $projectVersionService
     */
    private $projectVersionService;

    /**
     * @param IProjectVersionService $projectVersionService
     */
    public function __construct(IProjectVersionService $projectVersionService)
    {
        $this->projectVersionService = $projectVersionService;
    }

    /**
     * @param GetByProjectIdRequest $request
     */
    public function getByProjectId(GetByProjectIdRequest $request)
    {
        $getByProjectIdResponse = $this->projectVersionService->getByProjectId(
            $request->projectId,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
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
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->projectVersionService->getById($request->id);
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
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->projectVersionService->create(
            $request->projectId,
            $request->title,
            $request->version,
            $request->description,
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
        $updateResponse = $this->projectVersionService->update(
            $request->id,
            $request->title,
            $request->version,
            $request->description,
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
        $deleteResponse = $this->projectVersionService->delete($request->id);
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
