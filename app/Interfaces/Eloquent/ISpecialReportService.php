<?php

namespace App\Interfaces\Eloquent;

interface ISpecialReportService extends IEloquentService
{
    /**
     * @param int $companyId
     */
    public function getByCompanyId(
        int $companyId
    );
}
