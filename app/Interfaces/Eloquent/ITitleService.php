<?php

namespace App\Interfaces\Eloquent;

interface ITitleService extends IEloquentService
{
    /**
     * @param int $departmentId
     */
    public function getByDepartmentId(
        int $departmentId
    );

    /**
     * @param int $departmentId
     * @param string $name
     */
    public function create(
        int    $departmentId,
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
