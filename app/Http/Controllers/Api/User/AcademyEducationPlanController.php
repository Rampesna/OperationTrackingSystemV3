<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
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
