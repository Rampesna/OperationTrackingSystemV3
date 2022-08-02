<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IDevicePackageService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex,
        int    $pageSize,
        string $keyword = null
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getDevices(
        int $id
    ): ServiceResponse;

    /**
     * @param int $devicePackageId
     * @param array $deviceIds
     *
     * @return ServiceResponse
     */
    public function setDevices(
        int   $devicePackageId,
        array $deviceIds
    ): ServiceResponse;

    /**
     * @param int $devicePackageId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function updateEmployee(
        int $devicePackageId,
        int $employeeId
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
