<?php

namespace App\Interfaces\Eloquent;

interface IUserPermissionService extends IEloquentService
{
    /**
     * @param int|null $topId
     */
    public function getByTopId(
        ?int $topId = null
    );
}
