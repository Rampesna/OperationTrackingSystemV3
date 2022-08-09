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
     * @param int $employeeId
     * @param string $date
     */
    public function getByEmployeeIdAndDate(
        int    $employeeId,
        string $date,
    ): ServiceResponse;
}
