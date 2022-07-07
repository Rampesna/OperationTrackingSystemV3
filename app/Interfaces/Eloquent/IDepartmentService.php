<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IDepartmentService extends IEloquentService
{
    /**
     * @param int $branchId
     *
     * @return ServiceResponse
     */
    public function getByBranchId(
        int $branchId
    ): ServiceResponse;

    /**
     * @param int $branchId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $branchId,
        string $name
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse;
}
