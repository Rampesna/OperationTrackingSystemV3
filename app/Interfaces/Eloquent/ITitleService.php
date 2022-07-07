<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ITitleService extends IEloquentService
{
    /**
     * @param int $departmentId
     *
     * @return ServiceResponse
     */
    public function getByDepartmentId(
        int $departmentId
    );

    /**
     * @param int $departmentId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $departmentId,
        string $name
    );

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    );
}
