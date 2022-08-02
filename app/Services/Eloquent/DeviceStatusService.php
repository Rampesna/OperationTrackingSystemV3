<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IDeviceStatusService;
use App\Models\Eloquent\DeviceStatus;
use App\Services\ServiceResponse;

class DeviceStatusService implements IDeviceStatusService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All device categories',
            200,
            DeviceStatus::all()
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
        $deviceStatus = DeviceStatus::find($id);
        if ($deviceStatus) {
            return new ServiceResponse(
                true,
                'Device status',
                200,
                $deviceStatus
            );
        } else {
            return new ServiceResponse(
                false,
                'Device status not found',
                404,
                null
            );
        }
    }

    /**
     * @param string $name
     * @param string $color
     *
     * @return ServiceResponse
     */
    public function create(
        string $name,
        string $color
    ): ServiceResponse
    {
        $deviceStatus = new DeviceStatus;
        $deviceStatus->name = $name;
        $deviceStatus->color = $color;
        $deviceStatus->save();

        return new ServiceResponse(
            true,
            'Device status created',
            201,
            $deviceStatus
        );
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $color
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name,
        string $color
    ): ServiceResponse
    {
        $deviceStatus = $this->getById($id);
        if ($deviceStatus->isSuccess()) {
            $deviceStatus->getData()->name = $name;
            $deviceStatus->getData()->color = $color;
            $deviceStatus->getData()->save();

            return new ServiceResponse(
                true,
                'Device status updated',
                200,
                $deviceStatus->getData()
            );
        } else {
            return $deviceStatus;
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
        $deviceStatus = $this->getById($id);
        if ($deviceStatus->isSuccess()) {
            return new ServiceResponse(
                true,
                'Device status deleted',
                200,
                $deviceStatus->getData()->delete()
            );
        } else {
            return $deviceStatus;
        }
    }

}
