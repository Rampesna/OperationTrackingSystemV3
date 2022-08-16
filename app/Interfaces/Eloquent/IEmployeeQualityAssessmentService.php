<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IEmployeeQualityAssessmentService extends IEloquentService
{
    /**
     * @param int $userId
     * @param int $qualityAssessmentTypeId
     * @param int $pageIndex
     * @param int $pageSize
     *
     * @return ServiceResponse
     */
    public function getByUserId(
        int $userId,
        int $qualityAssessmentTypeId,
        int $pageIndex,
        int $pageSize
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param int $employeeId
     * @param int $qualityAssessmentListId
     * @param string $date
     * @param string|null $callNumber
     * @param string|null $callUrl
     * @param array $parameters
     *
     * @return ServiceResponse
     */
    public function create(
        int     $userId,
        int     $employeeId,
        int     $qualityAssessmentListId,
        string  $date,
        ?string $callNumber,
        ?string $callUrl,
        array   $parameters
    ): ServiceResponse;
}
