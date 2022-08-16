<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ProjectJobController\GetByProjectIdRequest;
use App\Http\Requests\Api\User\ProjectJobController\GetByIdRequest;
use App\Http\Requests\Api\User\ProjectJobController\CreateRequest;
use App\Http\Requests\Api\User\ProjectJobController\UpdateRequest;
use App\Http\Requests\Api\User\ProjectJobController\DeleteRequest;
use App\Interfaces\Eloquent\IProjectJobService;
use App\Traits\Response;

class ProjectJobController extends Controller
{
    use Response;

    /**
     * @var $projectJobService
     */
    private $projectJobService;

    /**
     * @param IProjectJobService $projectJobService
     */
    public function __construct(IProjectJobService $projectJobService)
    {
        $this->projectJobService = $projectJobService;
    }

    /**
     * @param GetByProjectIdRequest $request
     */
    public function getByProjectId(GetByProjectIdRequest $request)
    {
        $getByProjectIdResponse = $this->projectJobService->getByProjectId(
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
        $getByIdResponse = $this->projectJobService->getById($request->id);
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
        $createResponse = $this->projectJobService->create(
            $request->projectId,
            $request->user()->id,
            $request->landingCustomerId,
            $request->typeId,
            $request->code,
            $request->subject,
            $request->description,
            $request->image,
            $request->startDate,
            $request->endDate
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
        $updateResponse = $this->projectJobService->update(
            $request->id,
            $request->projectId,
            $request->user()->id,
            $request->landingCustomerId,
            $request->typeId,
            $request->code,
            $request->subject,
            $request->description,
            $request->image,
            $request->startDate,
            $request->endDate
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
        $deleteResponse = $this->projectJobService->delete($request->id);
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
