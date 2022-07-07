<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IFoodListService extends IEloquentService
{
    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        string $startDate,
        string $endDate
    );
}
