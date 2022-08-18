<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\CentralMissionController\GetByRelationRequest;
use App\Http\Requests\Api\Employee\CentralMissionController\GetByIdRequest;
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
}
