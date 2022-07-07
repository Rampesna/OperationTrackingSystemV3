<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPaymentService extends IEloquentService
{
    /**
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $date
     * @param int $amount
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function create(
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $date,
        int    $amount,
        string $description
    );

    /**
     * @param int $id
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $date
     * @param int $amount
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $date,
        int    $amount,
        string $description
    );

    /**
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        int    $employeeId,
        string $startDate,
        string $endDate
    );
}
