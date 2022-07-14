<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPermitTypeService;
use App\Models\Eloquent\PermitType;
use App\Services\ServiceResponse;

class PermitTypeService implements IPermitTypeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All permit types',
            200,
            PermitType::all()
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
        $permitType = PermitType::find($id);
        if ($permitType) {
            return new ServiceResponse(
                true,
                'Permit type',
                200,
                $permitType
            );
        } else {
            return new ServiceResponse(
                false,
                'Permit type not found',
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
        $permitType = $this->getById($id);
        if ($permitType->isSuccess()) {
            return new ServiceResponse(
                true,
                'Permit type deleted',
                200,
                $permitType->getData()->delete()
            );
        } else {
            return $permitType;
        }
    }
}
