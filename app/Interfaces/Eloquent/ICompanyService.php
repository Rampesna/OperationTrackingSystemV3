<?php

namespace App\Interfaces\Eloquent;

interface ICompanyService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function getUsersByCompanyIds(
        array   $companyIds,
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    );

    /**
     * @param int $id
     */
    public function tree(
        int $id
    );

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
        ?string $activeYear
    );

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
        ?string $activeYear
    );
}
