<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IUserPermissionService extends IEloquentService
{
    /**
     * @param int|null $topId
     *
     * @return ServiceResponse
     */
    public function getByTopId(
        ?int $topId = null
    ): ServiceResponse;
}
