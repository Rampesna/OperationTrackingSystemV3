<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ICommercialCompanyService extends IEloquentService
{
    /**
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
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
