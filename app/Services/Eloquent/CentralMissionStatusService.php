<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICentralMissionStatusService;
use App\Models\Eloquent\CentralMissionStatus;
use App\Services\ServiceResponse;

class CentralMissionStatusService implements ICentralMissionStatusService
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
            CentralMissionStatus::all()
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
        $centralMissionStatus = CentralMissionStatus::find($id);
        if ($centralMissionStatus) {
            return new ServiceResponse(
                true,
                'CentralMission type',
                200,
                $centralMissionStatus
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
        $centralMissionStatus = $this->getById($id);
        if ($centralMissionStatus->isSuccess()) {
            return new ServiceResponse(
                true,
                'CentralMission type deleted',
                200,
                $centralMissionStatus->getData()->delete()
            );
        } else {
            return $centralMissionStatus;
        }
    }
}
