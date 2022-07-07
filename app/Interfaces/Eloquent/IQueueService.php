<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IQueueService extends IEloquentService
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
     * @param int $queueId
     *
     * @return ServiceResponse
     */
    public function getQueueEmployees(
        int $queueId
    ): ServiceResponse;

    /**
     * @param int $queueId
     * @param array $employeeIds
     *
     * @return ServiceResponse
     */
    public function setQueueEmployees(
        int   $queueId,
        array $employeeIds
    ): ServiceResponse;

    /**
     * @param int $companyId
     * @param string $name
     * @param string $short
     * @param int|null $groupCode
     * @param int|null $otsCode
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name,
        string $short,
        ?int   $groupCode = null,
        ?int   $otsCode = null
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     * @param string $short
     * @param int|null $groupCode
     * @param int|null $otsCode
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name,
        string $short,
        ?int   $groupCode = null,
        ?int   $otsCode = null
    ): ServiceResponse;
}
