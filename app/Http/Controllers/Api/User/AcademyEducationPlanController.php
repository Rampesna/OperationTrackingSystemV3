<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\AcademyEducationPlanController\GetDateBetweenByCompanyIdsRequest;
use App\Http\Requests\Api\User\AcademyEducationPlanController\CreateBatchRequest;
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
}
