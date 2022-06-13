<?php

namespace App\Interfaces\Eloquent;

interface IQueueService extends IEloquentService
{
    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    );

    /**
     * @param int $queueId
     */
    public function getQueueEmployees(
        int $queueId
    );

    /**
     * @param int $queueId
     * @param array $employeeIds
     */
    public function setQueueEmployees(
        int   $queueId,
        array $employeeIds
    );
}
