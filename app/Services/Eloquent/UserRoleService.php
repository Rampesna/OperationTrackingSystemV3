<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IUserRoleService;
use App\Models\Eloquent\UserRole;

class UserRoleService implements IUserRoleService
{
    public function getAll()
    {
        return UserRole::all();
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function getAllUserRoles(
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    )
    {
        $userRoles = UserRole::with([]);

        if ($keyword) {
            $userRoles->where('name', 'like', '%' . $keyword . '%');
        }

        return [
            'totalCount' => $userRoles->count(),
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize,
            'userRoles' => $userRoles->skip($pageSize * $pageIndex)
                ->take($pageSize)
                ->get()
        ];
    }

    public function getById(
        int $id
    )
    {
        return UserRole::find($id);
    }

    /**
     * @param int $roleId
     */
    public function getUserPermissions(
        int $roleId
    )
    {
        return UserRole::find($roleId)->userPermissions;
    }

    /**
     * @param int $roleId
     * @param array $userPermissionIds
     */
    public function setUserPermissions(
        int   $roleId,
        array $userPermissionIds
    )
    {
        return UserRole::find($roleId)->userPermissions()->sync($userPermissionIds);
    }

    /**
     * @param string $name
     */
    public function create(
        string $name
    )
    {
        $userRole = new UserRole;
        $userRole->name = $name;
        $userRole->save();

        return $userRole;
    }

    /**
     * @param int $id
     * @param string $name
     */
    public function update(
        int    $id,
        string $name
    )
    {
        $userRole = $this->getById($id);
        $userRole->name = $name;
        $userRole->save();

        return $userRole;
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }
}
