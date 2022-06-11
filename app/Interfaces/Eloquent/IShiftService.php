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
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     */
    public function getByCompanyIds(
        array       $companyIds,
        string      $startDate,
        string      $endDate,
        string|null $keyword = null,
        array|null  $jobDepartmentIds
    );
}
