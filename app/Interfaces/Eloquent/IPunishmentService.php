<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPunishmentService extends IEloquentService
{
    /**
     * @param int $employeeId
     * @param int $pageIndex
     * @param int $pageSize
     * @param int|null $categoryId
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int  $employeeId,
        int  $pageIndex,
        int  $pageSize,
        ?int $categoryId,
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param int $categoryId
     * @param string $date
     * @param string|null $description
     * @param float|null $moneyDeduction
     * @param int|null $file
     *
     * @return ServiceResponse
     */
    public function create(
        int     $employeeId,
        int     $categoryId,
        string  $date,
        ?string $description,
        ?float  $moneyDeduction,
        ?int    $file
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $startDate
     * @param string $endDate
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $startDate,
        string $endDate,
        string $description
    ): ServiceResponse;
}
