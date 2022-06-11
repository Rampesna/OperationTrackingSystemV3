<?php

namespace App\Interfaces\Eloquent;

interface IJobDepartmentService extends IEloquentService
{
    /**
     * @param int $companyId
     */
    public function getByCompanyId(
        int $companyId
    );
}
