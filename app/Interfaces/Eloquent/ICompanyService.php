<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ICompanyService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getUsersByCompanyIds(
        array   $companyIds,
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function tree(
        int $id
    ): ServiceResponse;

    /**
     * @param string $title
     * @param string|null $taxOffice
     * @param string|null $taxNumber
     * @param string|null $recordNumber
     * @param int|null $commercialCompanyId
     * @param int|null $uyumCrmCompanyId
     * @param int|null $uyumCrmBranchId
     * @param string|null $uyumCrmBranchCode
     * @param string|null $activeYear
     * @param int $saturdayPermitService
     *
     * @return ServiceResponse
     */
    public function create(
        string  $title,
        ?string $taxOffice,
        ?string $taxNumber,
        ?string $recordNumber,
        ?int    $commercialCompanyId,
        ?int    $uyumCrmCompanyId,
        ?int    $uyumCrmBranchId,
        ?string $uyumCrmBranchCode,
        ?string $activeYear,
        int     $saturdayPermitService
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $title
     * @param string|null $taxOffice
     * @param string|null $taxNumber
     * @param string|null $recordNumber
     * @param int|null $commercialCompanyId
     * @param int|null $uyumCrmCompanyId
     * @param int|null $uyumCrmBranchId
     * @param string|null $uyumCrmBranchCode
     * @param string|null $activeYear
     * @param int $saturdayPermitService
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        string  $title,
        ?string $taxOffice,
        ?string $taxNumber,
        ?string $recordNumber,
        ?int    $commercialCompanyId,
        ?int    $uyumCrmCompanyId,
        ?int    $uyumCrmBranchId,
        ?string $uyumCrmBranchCode,
        ?string $activeYear,
        int     $saturdayPermitService
    ): ServiceResponse;
}
