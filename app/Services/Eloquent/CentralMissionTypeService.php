<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICentralMissionTypeService;
use App\Models\Eloquent\CentralMissionType;
use App\Services\ServiceResponse;

class CentralMissionTypeService implements ICentralMissionTypeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All centralMission types',
            200,
            CentralMissionType::all()
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
        $centralMissionType = CentralMissionType::find($id);
        if ($centralMissionType) {
            return new ServiceResponse(
                true,
                'CentralMission type',
                200,
                $centralMissionType
            );
        } else {
            return new ServiceResponse(
                false,
                'CentralMission type not found',
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
        $centralMissionType = $this->getById($id);
        if ($centralMissionType->isSuccess()) {
            return new ServiceResponse(
                true,
                'CentralMission type deleted',
                200,
                $centralMissionType->getData()->delete()
            );
        } else {
            return $centralMissionType;
        }
    }
}
