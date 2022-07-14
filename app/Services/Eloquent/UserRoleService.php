<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IUserRoleService;
use App\Models\Eloquent\UserRole;
use App\Services\ServiceResponse;

class UserRoleService implements IUserRoleService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All user roles',
            200,
            UserRole::all()
        );
    }

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
    ): ServiceResponse
    {
        $userRoles = UserRole::with([]);

        if ($keyword) {
            $userRoles->where('name', 'like', '%' . $keyword . '%');
        }

        return new ServiceResponse(
            true,
            'All user roles',
            200,
            [
                'totalCount' => $userRoles->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'userRoles' => $userRoles->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $userRole = UserRole::find($id);
        if ($userRole) {
            return new ServiceResponse(
                true,
                'User role',
                200,
                $userRole
            );
        } else {
            return new ServiceResponse(
                false,
                'User role not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $roleId
     *
     * @return ServiceResponse
     */
    public function getUserPermissions(
        int $roleId
    ): ServiceResponse
    {
        $userRole = $this->getById($roleId);
        if ($userRole->isSuccess()) {
            return new ServiceResponse(
                true,
                'User role permissions',
                200,
                $userRole->getData()->permissions
            );
        } else {
            return $userRole;
        }
    }

    /**
     * @param int $roleId
     * @param array $userPermissionIds
     *
     * @return ServiceResponse
     */
    public function setUserPermissions(
        int   $roleId,
        array $userPermissionIds
    ): ServiceResponse
    {
        $userRole = $this->getById($roleId);
        if ($userRole->isSuccess()) {
            $userRole->getData()->userPermissions()->sync($userPermissionIds);
            return new ServiceResponse(
                true,
                'User role permissions updated',
                200,
                $userRole->getData()
            );
        } else {
            return $userRole;
        }
    }

    /**
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        string $name
    ): ServiceResponse
    {
        $userRole = new UserRole;
        $userRole->name = $name;
        $userRole->save();

        return new ServiceResponse(
            true,
            'User role created',
            201,
            $userRole
        );
    }

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse
    {
        $userRole = $this->getById($id);
        if ($userRole->isSuccess()) {
            $userRole->getData()->name = $name;
            $userRole->getData()->save();
            return new ServiceResponse(
                true,
                'User role updated',
                200,
                $userRole->getData()
            );
        } else {
            return $userRole;
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $userRole = $this->getById($id);
        if ($userRole->isSuccess()) {
            return new ServiceResponse(
                true,
                'User role deleted',
                200,
                $userRole->getData()->delete()
            );
        } else {
            return $userRole;
        }
    }
}
