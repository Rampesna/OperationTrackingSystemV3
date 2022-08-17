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
            'All centralMission statuses',
            200,
            CentralMissionStatus::all()
        );
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
    ): ServiceResponse
    {
        $centralMissionStatuses = CentralMissionStatus::with([]);

        if ($keyword) {
            $centralMissionStatuses->where('name', 'like', '%' . $keyword . '%');
        }

        return new ServiceResponse(
            true,
            'Central mission statuses',
            200,
            [
                'totalCount' => $centralMissionStatuses->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'centralMissionStatuses' => $centralMissionStatuses->skip($pageSize * $pageIndex)
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
        $centralMissionStatus = CentralMissionStatus::find($id);
        if ($centralMissionStatus) {
            return new ServiceResponse(
                true,
                'CentralMission status',
                200,
                $centralMissionStatus
            );
        } else {
            return new ServiceResponse(
                false,
                'CentralMission status not found',
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
                'Central mission status deleted',
                200,
                $centralMissionStatus->getData()->delete()
            );
        } else {
            return $centralMissionStatus;
        }
    }

    /**
     * @param string $name
     */
    public function create(
        string $name
    ): ServiceResponse
    {
        $centralMissionStatus = new CentralMissionStatus;
        $centralMissionStatus->name = $name;
        $centralMissionStatus->save();

        return new ServiceResponse(
            true,
            'Central mission status created',
            201,
            $centralMissionStatus
        );
    }

    /**
     * @param int $id
     * @param string $name
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse
    {
        $centralMissionStatus = $this->getById($id);
        if ($centralMissionStatus->isSuccess()) {
            $centralMissionStatus->getData()->name = $name;
            $centralMissionStatus->getData()->save();

            return new ServiceResponse(
                true,
                'Central mission status updated',
                200,
                $centralMissionStatus
            );
        } else {
            return $centralMissionStatus;
        }
    }
}
