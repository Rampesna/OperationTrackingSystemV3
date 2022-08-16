<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IQualityAssessmentListService extends IEloquentService
{
    /**
     * @param int $qualityAssessmentTypeId
     *
     * @return ServiceResponse
     */
    public function getByQualityAssessmentTypeId(
        int $qualityAssessmentTypeId
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getParametersById(
        int $id
    ): ServiceResponse;
}
