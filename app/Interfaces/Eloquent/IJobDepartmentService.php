<?php

namespace App\Interfaces\Eloquent;

interface IJobDepartmentService extends IEloquentService
{
    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    );
}
