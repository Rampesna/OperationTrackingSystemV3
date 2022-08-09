<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CentralMissionController\GetByRelationRequest;
use App\Http\Requests\Api\User\CentralMissionController\GetByIdRequest;
use App\Http\Requests\Api\User\CentralMissionController\CreateRequest;
use App\Http\Requests\Api\User\CentralMissionController\UpdateRequest;
use App\Http\Requests\Api\User\CentralMissionController\UpdateDiagramRequest;
use App\Http\Requests\Api\User\CentralMissionController\DeleteRequest;
use App\Interfaces\Eloquent\ICentralMissionService;
use App\Traits\Response;

class CentralMissionController extends Controller
{
    use Response;

    /**
     * @var $centralMissionService
     */
    private $centralMissionService;

    /**
     * @param ICentralMissionService $centralMissionService
     */
    public function __construct(ICentralMissionService $centralMissionService)
    {
        $this->centralMissionService = $centralMissionService;
    }

    /**
     * @param GetByRelationRequest $request
     */
    public function getByRelation(GetByRelationRequest $request)
    {
        $getByRelationResponse = $this->centralMissionService->getByRelation(
            $request->relationType,
            $request->relationId,
            $request->pageIndex,
            $request->pageSize,
            $request->typeIds,
            $request->statusIds,
        );
        if ($getByRelationResponse->isSuccess()) {
            return $this->success(
                $getByRelationResponse->getMessage(),
                $getByRelationResponse->getData(),
                $getByRelationResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByRelationResponse->getMessage(),
                $getByRelationResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->centralMissionService->getById(
            $request->id
        );
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
        $createResponse = $this->centralMissionService->create(
            $request->typeId,
            $request->statusId,
            $request->relationId,
            $request->relationType,
            $request->title,
            $request->description,
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
        $updateResponse = $this->centralMissionService->update(
            $request->id,
            $request->typeId,
            $request->statusId,
            $request->relationId,
            $request->relationType,
            $request->title,
            $request->description,
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
     * @param UpdateDiagramRequest $request
     */
    public function updateDiagram(UpdateDiagramRequest $request)
    {
        $updateDiagramResponse = $this->centralMissionService->updateDiagram(
            $request->id,
            $request->diagram,
        );
        if ($updateDiagramResponse->isSuccess()) {
            return $this->success(
                $updateDiagramResponse->getMessage(),
                $updateDiagramResponse->getData(),
                $updateDiagramResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateDiagramResponse->getMessage(),
                $updateDiagramResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->centralMissionService->delete(
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
