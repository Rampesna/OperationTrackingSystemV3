<?php

namespace App\Interfaces\Eloquent;

interface IJobDepartmentService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $companyIds
     * @param string $keyword
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        string $keyword = null
    );

    /**
     * @param array $typeIds
     */
    public function getByTypeIds(
        array $typeIds
    );

    /**
     * @param int $companyId
     * @param string $name
     * @param int|null $typeId
     */
    public function create(
        int    $companyId,
        string $name,
        ?int   $typeId = null
    );

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     * @param int|null $typeId
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name,
        ?int   $typeId = null
    );
}
