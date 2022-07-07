<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IUserRoleService extends IEloquentService
{
    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getAllUserRoles(
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    );

    /**
     * @param int $roleId
     *
     * @return ServiceResponse
     */
    public function getUserPermissions(
        int $roleId
    );

    /**
     * @param int $roleId
     * @param array $userPermissionIds
     *
     * @return ServiceResponse
     */
    public function setUserPermissions(
        int   $roleId,
        array $userPermissionIds
    );

    /**
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        string $name
    );

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    );
}
