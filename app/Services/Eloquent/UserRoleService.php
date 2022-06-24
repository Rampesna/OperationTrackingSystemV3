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

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }
}
