<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IDevicePackageService;
use App\Http\Requests\Api\User\DevicePackageController\GetAllRequest;
use App\Http\Requests\Api\User\DevicePackageController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\DevicePackageController\GetByIdRequest;
use App\Http\Requests\Api\User\DevicePackageController\GetDevicesRequest;
use App\Http\Requests\Api\User\DevicePackageController\SetDevicesRequest;
use App\Http\Requests\Api\User\DevicePackageController\UpdateEmployeeRequest;
use App\Http\Requests\Api\User\DevicePackageController\CreateRequest;
use App\Http\Requests\Api\User\DevicePackageController\UpdateRequest;
use App\Http\Requests\Api\User\DevicePackageController\DeleteRequest;
use App\Traits\Response;

class DevicePackageController extends Controller
{
    use Response;

    /**
     * @var $devicePackageService
     */
    private $devicePackageService;

    /**
     * @param IDevicePackageService $devicePackageService
     */
    public function __construct(IDevicePackageService $devicePackageService)
    {
        $this->devicePackageService = $devicePackageService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->devicePackageService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $getAllResponse = $this->devicePackageService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->devicePackageService->getById(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetDevicesRequest $request
     */
    public function getDevices(GetDevicesRequest $request)
    {
        $getDevicesResponse = $this->devicePackageService->getDevices(
            $request->id
        );
        if ($getDevicesResponse->isSuccess()) {
            return $this->success(
                $getDevicesResponse->getMessage(),
                $getDevicesResponse->getData(),
                $getDevicesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDevicesResponse->getMessage(),
                $getDevicesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetDevicesRequest $request
     */
    public function setDevices(SetDevicesRequest $request)
    {
        $setDevicesResponse = $this->devicePackageService->setDevices(
            $request->devicePackageId,
            $request->deviceIds
        );
        if ($setDevicesResponse->isSuccess()) {
            return $this->success(
                $setDevicesResponse->getMessage(),
                $setDevicesResponse->getData(),
                $setDevicesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setDevicesResponse->getMessage(),
                $setDevicesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateEmployeeRequest $request
     */
    public function updateEmployee(UpdateEmployeeRequest $request)
    {
        $updateEmployeeResponse = $this->devicePackageService->updateEmployee(
            $request->devicePackageId,
            $request->employeeId
        );
        if ($updateEmployeeResponse->isSuccess()) {
            return $this->success(
                $updateEmployeeResponse->getMessage(),
                $updateEmployeeResponse->getData(),
                $updateEmployeeResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateEmployeeResponse->getMessage(),
                $updateEmployeeResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->devicePackageService->create(
            $request->companyId,
            $request->name
        );
        if ($createResponse->isSuccess()) {
            return $this->success(
                $createResponse->getMessage(),
                $createResponse->getData(),
                $createResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->devicePackageService->update(
            $request->id,
            $request->companyId,
            $request->name
        );
        if ($updateResponse->isSuccess()) {
            return $this->success(
                $updateResponse->getMessage(),
                $updateResponse->getData(),
                $updateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->devicePackageService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
