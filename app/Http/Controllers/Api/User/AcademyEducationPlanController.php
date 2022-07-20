<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\AcademyEducationPlanController\GetDateBetweenByCompanyIdsRequest;
use App\Http\Requests\Api\User\AcademyEducationPlanController\GetByIdRequest;
use App\Http\Requests\Api\User\AcademyEducationPlanController\CreateBatchRequest;
use App\Http\Requests\Api\User\AcademyEducationPlanController\UpdateRequest;
use App\Http\Requests\Api\User\AcademyEducationPlanController\DeleteRequest;
use App\Interfaces\Eloquent\IAcademyEducationPlanService;
use App\Traits\Response;

class AcademyEducationPlanController extends Controller
{
    use Response;

    /**
     * @var $academyEducationPlanService
     */
    private $academyEducationPlanService;

    /**
     * @param IAcademyEducationPlanService $academyEducationPlanService
     */
    public function __construct(IAcademyEducationPlanService $academyEducationPlanService)
    {
        $this->academyEducationPlanService = $academyEducationPlanService;
    }

    /**
     * @param GetDateBetweenByCompanyIdsRequest $request
     */
    public function getDateBetweenByCompanyIds(GetDateBetweenByCompanyIdsRequest $request)
    {
        $getDateBetweenByCompanyIdsResponse = $this->academyEducationPlanService->getDateBetweenByCompanyIds(
            $request->companyIds,
            $request->startDate,
            $request->endDate
        );
        if ($getDateBetweenByCompanyIdsResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenByCompanyIdsResponse->getMessage(),
                $getDateBetweenByCompanyIdsResponse->getData(),
                $getDateBetweenByCompanyIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenByCompanyIdsResponse->getMessage(),
                $getDateBetweenByCompanyIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->academyEducationPlanService->getById(
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
     * @param CreateBatchRequest $request
     */
    public function createBatch(CreateBatchRequest $request)
    {
        $createBatchResponse = $this->academyEducationPlanService->createBatch(
            $request->academyEducationPlans
        );
        if ($createBatchResponse->isSuccess()) {
            return $this->success(
                $createBatchResponse->getMessage(),
                $createBatchResponse->getData(),
                $createBatchResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createBatchResponse->getMessage(),
                $createBatchResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->academyEducationPlanService->update(
            $request->id,
            $request->educationist,
            $request->startDatetime,
            $request->academyEducationPlanTypeId,
            $request->location
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
        $deleteResponse = $this->academyEducationPlanService->delete(
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
