<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IAcademyEducationService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $companyIds
     * @param string $keyword
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        string $keyword = null
    ): ServiceResponse;

    /**
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name
    ): ServiceResponse;
}
