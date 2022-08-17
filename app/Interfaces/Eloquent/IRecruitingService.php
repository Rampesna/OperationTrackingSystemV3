<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IRecruitingService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param array|null $departmentIds
     * @param array|null $stepIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array   $companyIds,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null,
        ?array  $departmentIds = [],
        ?array  $stepIds = []
    ): ServiceResponse;
}
