<?php

namespace App\Interfaces\Eloquent;

interface IPriorityService extends IEloquentService
{
    /**
     * @param int $companyId
     */
    public function getByCompanyId(
        $companyId
    );

    /**
     * @param int $priorityId
     */
    public function getPriorityEmployees(
        int $priorityId
    );

    /**
     * @param int $priorityId
     * @param array $employeeIds
     */
    public function setPriorityEmployees(
        int   $priorityId,
        array $employeeIds
    );
}
