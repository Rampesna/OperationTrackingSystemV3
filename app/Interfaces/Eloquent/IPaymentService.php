<?php

namespace App\Interfaces\Eloquent;

interface IPaymentService extends IEloquentService
{
    /**
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $date
     * @param int $amount
     * @param string $description
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
