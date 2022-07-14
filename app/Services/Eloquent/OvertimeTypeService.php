<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IOvertimeTypeService;
use App\Models\Eloquent\OvertimeType;
use App\Services\ServiceResponse;

class OvertimeTypeService implements IOvertimeTypeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All overtime types',
            200,
            OvertimeType::all()
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
        $overtimeType = OvertimeType::find($id);
        if ($overtimeType) {
            return new ServiceResponse(
                true,
                'Overtime type',
                200,
                $overtimeType
            );
        } else {
            return new ServiceResponse(
                false,
                'Overtime type not found',
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
        $overtimeType = $this->getById($id);
        if ($overtimeType->isSuccess()) {
            return new ServiceResponse(
                true,
                'Overtime type deleted',
                200,
                $overtimeType->getData()->delete()
            );
        } else {
            return $overtimeType;
        }
    }
}
