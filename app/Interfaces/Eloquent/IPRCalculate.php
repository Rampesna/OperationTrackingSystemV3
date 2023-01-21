<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPRCalculate
{
    /**
     * @param int $jobDepartmentId
     * @param string $date
     * @param int $calculateType
     *
     * @return ServiceResponse
     */
    public function calculate(
        int    $jobDepartmentId,
        string $date,
        int    $calculateType
    ): ServiceResponse;
}
