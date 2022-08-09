<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ISaturdayPermitService extends IEloquentService
{
    /**
     * @param string $month
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function robot(
        string $month,
        int    $companyId,
    ): ServiceResponse;

    /**
     * @param string $date
     */
    public function getByDate(
        string $date,
    ): ServiceResponse;

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     */
    public function getDateBetween(
        array   $companyIds,
        string  $startDate,
        string  $endDate,
        ?string $keyword = null,
        ?array  $jobDepartmentIds = [],
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string $date
     */
    public function getByEmployeeIdAndDate(
        int    $employeeId,
        string $date,
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $shiftGroupId
     * @param int $cancelReasonId
     * @param int $authUserId
     */
    public function cancel(
        int $id,
        int $shiftGroupId,
        int $cancelReasonId,
        int $authUserId
    ): ServiceResponse;
}
