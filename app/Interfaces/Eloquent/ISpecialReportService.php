<?php

namespace App\Interfaces\Eloquent;

interface ISpecialReportService extends IEloquentService
{
    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    );
}
