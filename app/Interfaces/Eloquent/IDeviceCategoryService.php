<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IDeviceCategoryService extends IEloquentService
{
    /**
     * @param string $name
     * @param string $icon
     *
     * @return ServiceResponse
     */
    public function create(
        string $name,
        string $icon
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $name
     * @param string $icon
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name,
        string $icon
    ): ServiceResponse;
}
