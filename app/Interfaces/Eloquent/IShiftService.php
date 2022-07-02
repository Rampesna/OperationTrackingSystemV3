<?php

namespace App\Interfaces\Eloquent;

interface IShiftService extends IEloquentService
{
    /**
     * @param int $companyId
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     */
    public function getByCompanyId(
        int         $companyId,
        string      $startDate,
        string      $endDate,
        string|null $keyword = null,
        array|null  $jobDepartmentIds
    );

    /**
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     */
    public function getDateBetweenByEmployeeId(
        int    $employeeId,
        string $startDate,
        string $endDate,
    );

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     * @param array|null $shiftGroupIds
     */
    public function getByCompanyIds(
        array       $companyIds,
        string      $startDate,
        string      $endDate,
        string|null $keyword = null,
        array|null  $jobDepartmentIds,
        array|null  $shiftGroupIds
    );

    /**
     * @param int $companyId
     * @param string $month
     * @param int $userId
     */
    public function robot(
        int    $companyId,
        string $month,
        int    $userId
    );

    /**
     * @param array $shiftIds
     */
    public function deleteByIds(
        array $shiftIds
    );
}
