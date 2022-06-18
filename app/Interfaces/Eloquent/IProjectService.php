<?php

namespace App\Interfaces\Eloquent;

interface IProjectService extends IEloquentService
{
    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    );

    /**
     * @param array $projectIds
     */
    public function getByProjectIds(
        array $projectIds
    );
}
