<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ITimesheetService extends IEloquentService
{
    /**
     * @param int $taskId
     * @param int $starterId
     * @param string $startTime
     *
     * @return ServiceResponse
     */
    public function create(
        int    $taskId,
        int    $starterId,
        string $startTime
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $endTime
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function setEndTime(
        int     $id,
        string  $endTime,
        ?string $description = null
    ): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function getActiveTimesheets(): ServiceResponse;

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        string $startDate,
        string $endDate
    ): ServiceResponse;
}
