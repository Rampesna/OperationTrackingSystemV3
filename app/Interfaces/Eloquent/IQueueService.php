<?php

namespace App\Interfaces\Eloquent;

interface IQueueService extends IEloquentService
{
    /**
     * @param int $companyId
     */
    public function getByCompanyId(
        int $companyId
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
