<?php

namespace App\Interfaces\Eloquent;

interface IUserRoleService extends IEloquentService
{
    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function getAllUserRoles(
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    );
}
