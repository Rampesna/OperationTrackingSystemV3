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

    /**
     * @param int $roleId
     */
    public function getUserPermissions(
        int $roleId
    );

    /**
     * @param int $roleId
     * @param array $userPermissionIds
     */
    public function setUserPermissions(
        int   $roleId,
        array $userPermissionIds
    );

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
