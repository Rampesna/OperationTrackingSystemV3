<?php

namespace App\Interfaces\Eloquent;

interface ICommercialCompanyService extends IEloquentService
{
    /**
     * @param string $name
     */
    public function create(
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
