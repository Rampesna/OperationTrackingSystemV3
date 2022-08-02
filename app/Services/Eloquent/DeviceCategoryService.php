<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IDeviceCategoryService;
use App\Models\Eloquent\DeviceCategory;
use App\Services\ServiceResponse;

class DeviceCategoryService implements IDeviceCategoryService
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
            DeviceCategory::all()
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
        $deviceCategory = DeviceCategory::find($id);
        if ($deviceCategory) {
            return new ServiceResponse(
                true,
                'Device category',
                200,
                $deviceCategory
            );
        } else {
            return new ServiceResponse(
                false,
                'Device category not found',
                404,
                null
            );
        }
    }

    /**
     * @param string $name
     * @param string $icon
     *
     * @return ServiceResponse
     */
    public function create(
        string $name,
        string $icon
    ): ServiceResponse
    {
        $deviceCategory = new DeviceCategory;
        $deviceCategory->name = $name;
        $deviceCategory->icon = $icon;
        $deviceCategory->save();

        return new ServiceResponse(
            true,
            'Device category created',
            201,
            $deviceCategory
        );
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $icon
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name,
        string $icon
    ): ServiceResponse
    {
        $deviceCategory = $this->getById($id);
        if ($deviceCategory->isSuccess()) {
            $deviceCategory->getData()->name = $name;
            $deviceCategory->getData()->icon = $icon;
            $deviceCategory->getData()->save();

            return new ServiceResponse(
                true,
                'Device category updated',
                200,
                $deviceCategory->getData()
            );
        } else {
            return $deviceCategory;
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
        $deviceCategory = $this->getById($id);
        if ($deviceCategory->isSuccess()) {
            return new ServiceResponse(
                true,
                'Device category deleted',
                200,
                $deviceCategory->getData()->delete()
            );
        } else {
            return $deviceCategory;
        }
    }

}
