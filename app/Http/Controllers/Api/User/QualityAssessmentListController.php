<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IQualityAssessmentListService;
use App\Http\Requests\Api\User\QualityAssessmentListController\GetByQualityAssessmentTypeIdRequest;
use App\Http\Requests\Api\User\QualityAssessmentListController\GetParametersByIdRequest;
use App\Traits\Response;

class QualityAssessmentListController extends Controller
{
    use Response;

    /**
     * @var $qualityAssessmentListService
     */
    private $qualityAssessmentListService;

    /**
     * @param IQualityAssessmentListService $qualityAssessmentListService
     */
    public function __construct(IQualityAssessmentListService $qualityAssessmentListService)
    {
        $this->qualityAssessmentListService = $qualityAssessmentListService;
    }

    /**
     * @param GetByQualityAssessmentTypeIdRequest $request
     */
    public function getByQualityAssessmentTypeId(GetByQualityAssessmentTypeIdRequest $request)
    {
        $getByQualityAssessmentTypeIdResponse = $this->qualityAssessmentListService->getByQualityAssessmentTypeId(
            $request->qualityAssessmentTypeId
        );
        if ($getByQualityAssessmentTypeIdResponse->isSuccess()) {
            return $this->success(
                $getByQualityAssessmentTypeIdResponse->getMessage(),
                $getByQualityAssessmentTypeIdResponse->getData(),
                $getByQualityAssessmentTypeIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByQualityAssessmentTypeIdResponse->getMessage(),
                $getByQualityAssessmentTypeIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetParametersByIdRequest $request
     */
    public function getParametersById(GetParametersByIdRequest $request)
    {
        $getParametersByIdResponse = $this->qualityAssessmentListService->getParametersById(
            $request->id
        );
        if ($getParametersByIdResponse->isSuccess()) {
            return $this->success(
                $getParametersByIdResponse->getMessage(),
                $getParametersByIdResponse->getData(),
                $getParametersByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getParametersByIdResponse->getMessage(),
                $getParametersByIdResponse->getStatusCode()
            );
        }
    }
}
