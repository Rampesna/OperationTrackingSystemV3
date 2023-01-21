<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPRCardService extends IEloquentService
{
    /**
     * @param int $jobDepartmentId
     *
     * @return ServiceResponse
     */
    public function getByJobDepartmentId(
        int $jobDepartmentId,
    ): ServiceResponse;

    /**
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        string $name,
        int $jobDepartmentId,
    ): ServiceResponse;

    public function update(
        int $id,
        string $name,
    ): ServiceResponse;
}
