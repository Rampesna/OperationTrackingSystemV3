<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ISpecialReportService extends IEloquentService
{
    /**
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array $companyIds
    ): ServiceResponse;
}
