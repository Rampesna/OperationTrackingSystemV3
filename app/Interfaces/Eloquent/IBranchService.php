<?php

namespace App\Interfaces\Eloquent;

interface IBranchService extends IEloquentService
{
    /**
     * @param int $companyId
     */
    public function getByCompanyId(
        int $companyId
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
     * @param string $name
     */
    public function update(
        int    $id,
        string $name
    );
}
