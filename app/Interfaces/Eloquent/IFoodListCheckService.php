<?php

namespace App\Interfaces\Eloquent;

interface IFoodListCheckService extends IEloquentService
{
    /**
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     */
    public function getDateBetween(
        int    $employeeId,
        string $startDate,
        string $endDate
    );
}
