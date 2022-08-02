<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IDeviceService;
use App\Models\Eloquent\Device;
use App\Services\ServiceResponse;

class DeviceService implements IDeviceService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All devices',
            200,
            Device::all()
        );
    }

    public function getById(
        int $id
    ): ServiceResponse
    {
        $device = Device::find($id);
        if ($device) {
            return new ServiceResponse(
                true,
                'Device',
                200,
                $device
            );
        } else {
            return new ServiceResponse(
                false,
                'Device not found',
                404,
                null
            );
        }
    }

    public function delete(
        int $id
    ): ServiceResponse
    {
        $device = $this->getById($id);
        if ($device->isSuccess()) {
            $device->getData()->delete();
            return new ServiceResponse(
                true,
                'Device deleted',
                200,
                null
            );
        } else {
            return $device;
        }
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string $keyword
     * @param array|null $categoryIds
     * @param array|null $statusIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        string $keyword = null,
        array  $categoryIds = null,
        array  $statusIds = null
    ): ServiceResponse
    {
        $devices = Device::with([
            'company',
            'category',
            'status',
            'employee',
            'package'
        ])->orderBy('id', 'desc')->whereIn('company_id', $companyIds);

        if ($keyword) {
            $devices->where(function ($devices) use ($keyword) {
                $devices->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('brand', 'like', '%' . $keyword . '%')
                    ->orWhere('model', 'like', '%' . $keyword . '%')
                    ->orWhere('serial_number', 'like', '%' . $keyword . '%')
                    ->orWhere('ip_address', 'like', '%' . $keyword . '%');
            });
        }

        if ($categoryIds && count($categoryIds) > 0) {
            $devices->whereIn('category_id', $categoryIds);
        }

        if ($statusIds && count($statusIds) > 0) {
            $devices->whereIn('status_id', $statusIds);
        }

        return new ServiceResponse(
            true,
            'Devices',
            200,
            [
                'totalCount' => $devices->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'devices' => $devices->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param array $ids
     *
     * @return ServiceResponse
     */
    public function getByIds(
        array $ids
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Devices',
            200,
            Device::whereIn('id', $ids)->get()
        );
    }

    /**
     * @param int $packageId
     *
     * @return ServiceResponse
     */
    public function getByPackageId(
        int $packageId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Devices',
            200,
            Device::where('package_id', $packageId)->get()
        );
    }

    /**
     * @param array $ids
     * @param int|null $packageId
     *
     * @return ServiceResponse
     */
    public function updatePackageIdByIds(
        array    $ids,
        int|null $packageId = null
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Devices',
            200,
            Device::whereIn('id', $ids)->update(['package_id' => $packageId])
        );
    }

    /**
     * @param array $ids
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function updateEmployeeIdByIds(
        array $ids,
        int   $employeeId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Devices',
            200,
            Device::whereIn('id', $ids)->update(['employee_id' => $employeeId])
        );
    }

    /**
     * @param int $companyId
     * @param int $categoryId
     * @param int $statusId
     * @param int|null $employeeId
     * @param string|null $name
     * @param string|null $brand
     * @param string|null $model
     * @param string|null $serialNumber
     * @param string|null $ipAddress
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        int    $categoryId,
        int    $statusId,
        int    $employeeId = null,
        string $name = null,
        string $brand = null,
        string $model = null,
        string $serialNumber = null,
        string $ipAddress = null
    ): ServiceResponse
    {
        $device = new Device;
        $device->company_id = $companyId;
        $device->category_id = $categoryId;
        $device->status_id = $statusId;
        $device->employee_id = $employeeId;
        $device->name = $name;
        $device->brand = $brand;
        $device->model = $model;
        $device->serial_number = $serialNumber;
        $device->ip_address = $ipAddress;
        $device->save();

        return new ServiceResponse(
            true,
            'Device created',
            201,
            $device
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param int $categoryId
     * @param int $statusId
     * @param int|null $employeeId
     * @param string|null $name
     * @param string|null $brand
     * @param string|null $model
     * @param string|null $serialNumber
     * @param string|null $ipAddress
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        int    $categoryId,
        int    $statusId,
        int    $employeeId = null,
        string $name = null,
        string $brand = null,
        string $model = null,
        string $serialNumber = null,
        string $ipAddress = null
    ): ServiceResponse
    {
        $device = $this->getById($id);
        if ($device->isSuccess()) {
            $device->getData()->company_id = $companyId;
            $device->getData()->category_id = $categoryId;
            $device->getData()->status_id = $statusId;
            $device->getData()->employee_id = $employeeId;
            $device->getData()->name = $name;
            $device->getData()->brand = $brand;
            $device->getData()->model = $model;
            $device->getData()->serial_number = $serialNumber;
            $device->getData()->ip_address = $ipAddress;
            $device->getData()->save();

            return new ServiceResponse(
                true,
                'Device updated',
                200,
                $device->getData()
            );
        } else {
            return $device;
        }
    }
}
