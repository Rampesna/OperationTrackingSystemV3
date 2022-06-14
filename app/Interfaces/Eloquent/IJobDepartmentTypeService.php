<?php

namespace App\Interfaces\Eloquent;

interface IJobDepartmentTypeService extends IEloquentService
{
    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    );
}
