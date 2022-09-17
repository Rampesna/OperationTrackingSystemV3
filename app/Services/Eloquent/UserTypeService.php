<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IUserTypeService;
use App\Models\Eloquent\UserType;
use App\Services\ServiceResponse;

class UserTypeService implements IUserTypeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All user types',
            200,
            UserType::all()
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
        $userType = UserType::find($id);
        if ($userType) {
            return new ServiceResponse(
                true,
                'User type',
                200,
                $userType
            );
        } else {
            return new ServiceResponse(
                false,
                'User type not found',
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
        $userType = $this->getById($id);
        if ($userType->isSuccess()) {
            return new ServiceResponse(
                true,
                'User type deleted',
                200,
                $userType->getData()->delete()
            );
        } else {
            return $userType;
        }
    }
}
