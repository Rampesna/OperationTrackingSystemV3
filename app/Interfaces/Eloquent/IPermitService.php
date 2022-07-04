<?php

namespace App\Interfaces\Eloquent;

interface IPermitService extends IEloquentService
{
    /**
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $startDate
     * @param string $endDate
     * @param string $description
     */
    public function create(
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $startDate,
        string $endDate,
        string $description
    );

    /**
     * @param int $id
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $startDate
     * @param string $endDate
     * @param string $description
     */
    public function update(
        int    $id,
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $startDate,
        string $endDate,
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
