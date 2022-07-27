<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IOvertimeService extends IEloquentService
{
    /**
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $startDate
     * @param string $endDate
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function create(
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $startDate,
        string $endDate,
        string $description
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $startDate
     * @param string $endDate
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $startDate,
        string $endDate,
        string $description
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        int    $employeeId,
        string $startDate,
        string $endDate
    ): ServiceResponse;

    /**
     * @param int $statusId
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function getByStatusIdAndCompanyIds(
        int   $statusId,
        array $companyIds
    ): ServiceResponse;

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param string|null $startDate
     * @param string|null $endDate
     * @param int|null $statusId
     * @param int|null $typeId
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array   $companyIds,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword,
        ?string $startDate,
        ?string $endDate,
        ?int    $statusId,
        ?int    $typeId
    ): ServiceResponse;

    /**
     * @param string $date
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function getByDateAndCompanyIds(
        string $date,
        array  $companyIds
    ): ServiceResponse;

    /**
     * @param int $overtimeId
     * @param int $statusId
     *
     * @return ServiceResponse
     */
    public function setStatus(
        int $overtimeId,
        int $statusId
    ): ServiceResponse;
}
