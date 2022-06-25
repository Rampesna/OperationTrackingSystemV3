<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IUserPermissionService;
use App\Models\Eloquent\UserPermission;

class UserPermissionService implements IUserPermissionService
{
    public function getAll()
    {
        return UserPermission::all();
    }

    public function getById(
        int $id
    )
    {
        return UserPermission::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function getByTopId(
        ?int $topId = null
    )
    {
        return UserPermission::where('top_id', $topId)->get();
    }
}
