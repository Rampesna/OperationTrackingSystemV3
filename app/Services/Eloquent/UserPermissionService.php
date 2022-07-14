<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IUserPermissionService;
use App\Models\Eloquent\UserPermission;
use App\Services\ServiceResponse;

class UserPermissionService implements IUserPermissionService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All user permissions',
            200,
            UserPermission::all()
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
        $userPermission = UserPermission::find($id);
        if ($userPermission) {
            return new ServiceResponse(
                true,
                'User permission',
                200,
                $userPermission
            );
        } else {
            return new ServiceResponse(
                false,
                'User permission not found',
                404,
                null
            );
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
        $userPermission = $this->getById($id);
        if ($userPermission->isSuccess()) {
            return new ServiceResponse(
                true,
                'User permission deleted',
                200,
                $userPermission->getData()->delete()
            );
        } else {
            return $userPermission;
        }
    }

    /**
     * @param int|null $topId
     *
     * @return ServiceResponse
     */
    public function getByTopId(
        ?int $topId = null
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'User permissions',
            200,
            UserPermission::where('top_id', $topId)->get()
        );
    }
}
