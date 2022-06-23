<?php

namespace App\Interfaces\Eloquent;

interface IDepartmentService extends IEloquentService
{
    /**
     * @param int $branchId
     */
    public function getByBranchId(
        int $branchId
    );

    /**
     * @param int $branchId
     * @param string $name
     */
    public function create(
        int    $branchId,
        string $name
    );

    /**
     * @param int $id
     * @param string $name
     */
    public function update(
        int    $id,
        string $name
    );
}
