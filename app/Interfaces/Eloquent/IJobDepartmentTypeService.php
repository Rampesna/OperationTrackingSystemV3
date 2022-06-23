<?php

namespace App\Interfaces\Eloquent;

interface IJobDepartmentTypeService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function getByCompanyIds(
        array       $companyIds,
        int         $pageIndex = 0,
        int         $pageSize = 10,
        string|null $keyword = null
    );

    /**
     * @param int $companyId
     * @param string $name
     */
    public function create(
        int    $companyId,
        string $name
    );

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name
    );
}
