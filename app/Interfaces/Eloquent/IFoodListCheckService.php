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

    /**
     * @param int $id
     * @param int|null $checked
     * @param int|null $liked
     * @param int $count
     * @param string|null $description
     */
    public function update(
        int         $id,
        int|null    $checked,
        int|null    $liked,
        int         $count,
        string|null $description
    );
}
