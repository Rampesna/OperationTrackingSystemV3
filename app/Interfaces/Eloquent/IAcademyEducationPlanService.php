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

    /**
     * @param int $id
     * @param int $academyEducationLessonId
     * @param string $educationist
     * @param string $startDatetime
     * @param int $academyEducationPlanTypeId
     * @param string $location
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $educationist,
        string $startDatetime,
        int    $academyEducationPlanTypeId,
        string $location
    ): ServiceResponse;

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetweenByCompanyIds(
        array  $companyIds,
        string $startDate,
        string $endDate
    ): ServiceResponse;
}
