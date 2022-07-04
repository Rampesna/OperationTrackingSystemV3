<?php

namespace App\Interfaces\Eloquent;

interface IFoodListService extends IEloquentService
{
    /**
     * @param string $startDate
     * @param string $endDate
     */
    public function getDateBetween(
        string $startDate,
        string $endDate
    );
}
