<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPunishmentService extends IEloquentService
{
    /**
     * @param int $employeeId
     * @param int $pageIndex
     * @param int $pageSize
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int $employeeId,
        int $pageIndex,
        int $pageSize
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param int $categoryId
     * @param string $date
     * @param string|null $description
     * @param float|null $moneyDeduction
     *
     * @return ServiceResponse
     */
    public function create(
        int     $employeeId,
        int     $categoryId,
        string  $date,
        ?string $description,
        ?float  $moneyDeduction
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $employeeId
     * @param int $categoryId
     * @param string $date
     * @param string|null $description
     * @param float|null $moneyDeduction
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $categoryId,
        string  $date,
        ?string $description,
        ?float  $moneyDeduction
    ): ServiceResponse;
}
