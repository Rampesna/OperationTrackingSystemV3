<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IDevicePackageService;
use App\Interfaces\Eloquent\IDeviceService;
use App\Models\Eloquent\DevicePackage;
use App\Services\ServiceResponse;

class DevicePackageService implements IDevicePackageService
{
    /**
     * @var $deviceService
     */
    private $deviceService;

    /**
     * @param IDeviceService $deviceService
     */
    public function __construct(IDeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All device categories',
            200,
            DevicePackage::all()
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
        $devicePackage = DevicePackage::find($id);
        if ($devicePackage) {
            return new ServiceResponse(
                true,
                'Device package',
                200,
                $devicePackage
            );
        } else {
            return new ServiceResponse(
                false,
                'Device package not found',
                404,
                null
            );
        }
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex,
        int    $pageSize,
        string $keyword = null
    ): ServiceResponse
    {
        $devicePackages = DevicePackage::with([
            'company'
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $devicePackages->where('name', 'like', '%' . $keyword . '%');
        }

        return new ServiceResponse(
            true,
            'All device packages',
            200,
            [
                'totalCount' => $devicePackages->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'devicePackages' => $devicePackages->skip($pageSize * $pageIndex)
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
    public function getDevices(
        int $id
    ): ServiceResponse
    {
        $devicePackage = $this->getById($id);
        if ($devicePackage->isSuccess()) {
            return new ServiceResponse(
                true,
                'Device package devices',
                200,
                $devicePackage->getData()->devices
            );
        } else {
            return $devicePackage;
        }
    }

    /**
     * @param int $devicePackageId
     * @param array $deviceIds
     *
     * @return ServiceResponse
     */
    public function setDevices(
        int   $devicePackageId,
        array $deviceIds
    ): ServiceResponse
    {
        $getByPackageIdResponse = $this->deviceService->getByPackageId($devicePackageId);
        if ($getByPackageIdResponse->isSuccess()) {
            $updatePackageIdByIdsResponse = $this->deviceService->updatePackageIdByIds(
                $getByPackageIdResponse->getData()->pluck('id')->toArray(),
                null
            );
            if ($updatePackageIdByIdsResponse->isSuccess()) {
                $getByIdsResponse = $this->deviceService->getByIds($deviceIds);
                if ($getByIdsResponse) {
                    $updatePackageIdByIdsResponse = $this->deviceService->updatePackageIdByIds(
                        $getByIdsResponse->getData()->pluck('id')->toArray(),
                        $devicePackageId
                    );
                    if ($updatePackageIdByIdsResponse->isSuccess()) {
                        return new ServiceResponse(
                            true,
                            'Device package devices updated',
                            200,
                            null
                        );
                    } else {
                        return $updatePackageIdByIdsResponse;
                    }
                } else {
                    return $getByIdsResponse;
                }
            } else {
                return $updatePackageIdByIdsResponse;
            }
        } else {
            return $getByPackageIdResponse;
        }
    }

    /**
     * @param int $devicePackageId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function updateEmployee(
        int $devicePackageId,
        int $employeeId
    ): ServiceResponse
    {
        $getByEmployeeIdResponse = $this->deviceService->getByEmployeeId($employeeId);
        if ($getByEmployeeIdResponse->isSuccess()) {
            $updateEmployeeIdByIdsResponse = $this->deviceService->updateEmployeeIdByIds(
                $getByEmployeeIdResponse->getData()->pluck('id')->toArray()
            );
            if ($updateEmployeeIdByIdsResponse->isSuccess()) {
                $getByPackageIdResponse = $this->deviceService->getByPackageId($devicePackageId);
                if ($getByPackageIdResponse->isSuccess()) {
                    $updateEmployeeIdByIdsResponse = $this->deviceService->updateEmployeeIdByIds(
                        $getByPackageIdResponse->getData()->pluck('id')->toArray(),
                        $employeeId
                    );
                    if ($updateEmployeeIdByIdsResponse->isSuccess()) {
                        return new ServiceResponse(
                            true,
                            'Device package employee updated',
                            200,
                            null
                        );
                    } else {
                        return $updateEmployeeIdByIdsResponse;
                    }
                } else {
                    return $getByPackageIdResponse;
                }
            } else {
                return $updateEmployeeIdByIdsResponse;
            }
        } else {
            return $getByEmployeeIdResponse;
        }
    }

    /**
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name
    ): ServiceResponse
    {
        $devicePackage = new DevicePackage;
        $devicePackage->company_id = $companyId;
        $devicePackage->name = $name;
        $devicePackage->save();

        return new ServiceResponse(
            true,
            'Device package created',
            201,
            $devicePackage
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name
    ): ServiceResponse
    {
        $devicePackage = $this->getById($id);
        if ($devicePackage->isSuccess()) {
            $devicePackage->getData()->company_id = $companyId;
            $devicePackage->getData()->name = $name;
            $devicePackage->getData()->save();

            return new ServiceResponse(
                true,
                'Device package updated',
                200,
                $devicePackage->getData()
            );
        } else {
            return $devicePackage;
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
        $devicePackage = $this->getById($id);
        if ($devicePackage->isSuccess()) {
            return new ServiceResponse(
                true,
                'Device package deleted',
                200,
                $devicePackage->getData()->delete()
            );
        } else {
            return $devicePackage;
        }
    }

}
