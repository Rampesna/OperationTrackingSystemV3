<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IAcademyEducationPlanService extends IEloquentService
{
    /**
     * @param array $academyEducationPlans {
     * @param int $academyEducationLessonId
     * @param string $educationist
     * @param string $startDatetime
     * @param int $academyEducationPlanTypeId
     * @param string $location
     * @param  }
     *
     * @return ServiceResponse
     */
    public function createBatch(
        array $academyEducationPlans
    ): ServiceResponse;


}
