<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IFoodListCheckService extends IEloquentService
{
    /**
     * @param int $employeeId
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        int    $employeeId,
        array  $companyIds,
        string $startDate,
        string $endDate
    ): ServiceResponse;

    /**
     * @param int $foodListId
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function createBatch(
        int $foodListId,
        int $companyId
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int|null $checked
     * @param int|null $liked
     * @param int $count
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function update(
        int         $id,
        int|null    $checked,
        int|null    $liked,
        int         $count,
        string|null $description
    ): ServiceResponse;
}
