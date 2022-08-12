<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IShiftService extends IEloquentService
{
    /**
     * @param int $companyId
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyId(
        int         $companyId,
        string      $startDate,
        string      $endDate,
        string|null $keyword = null,
        array|null  $jobDepartmentIds
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetweenByEmployeeId(
        int    $employeeId,
        string $startDate,
        string $endDate,
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int    $employeeId,
        string $startDate,
        string $endDate,
    ): ServiceResponse;

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     * @param array|null $shiftGroupIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array       $companyIds,
        string      $startDate,
        string      $endDate,
        string|null $keyword = null,
        array|null  $jobDepartmentIds,
        array|null  $shiftGroupIds
    ): ServiceResponse;

    /**
     * @param array $shifts {
     * @param int $companyId
     * @param int $employeeId
     * @param int $shiftGroupId
     * @param string $startDate
     * @param string $endDate
     * }
     * @param int $authUserId
     *
     * @return ServiceResponse
     */
    public function createBatch(
        array $shifts,
        int   $authUserId
    ): ServiceResponse;

    /**
     * @param int $authUserId
     * @param int $employeeId
     * @param int $shiftGroupId
     * @param string $month
     */
    public function createEmployeeFirstShifts(
        int    $authUserId,
        int    $employeeId,
        int    $shiftGroupId,
        string $month,
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $shiftGroupId
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $shiftGroupId,
        string $startDate,
        string $endDate
    ): ServiceResponse;

    /**
     * @param array $employeeIds
     * @param int $authUserId
     * @param string $date
     * @param string $startTime
     * @param string $endTime
     *
     * @return ServiceResponse
     */
    public function updateBatch(
        array  $employeeIds,
        int    $authUserId,
        string $date,
        string $startTime,
        string $endTime
    ): ServiceResponse;

    /**
     * @param int $companyId
     * @param string $month
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function robot(
        int    $companyId,
        string $month,
        int    $userId
    ): ServiceResponse;

    /**
     * @param array $shiftIds
     *
     * @return ServiceResponse
     */
    public function deleteByIds(
        array $shiftIds
    ): ServiceResponse;
}
