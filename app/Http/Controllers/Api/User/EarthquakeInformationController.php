<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EarthquakeInformationController\GetAllRequest;
use App\Http\Requests\Api\User\EarthquakeInformationController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\EarthquakeInformationController\GetUnregisteredByCompanyIdsRequest;
use App\Http\Requests\Api\User\EarthquakeInformationController\CheckIfExistsRequest;
use App\Http\Requests\Api\User\EarthquakeInformationController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\User\EarthquakeInformationController\CreateRequest;
use App\Http\Requests\Api\User\EarthquakeInformationController\UpdateRequest;
use App\Interfaces\Eloquent\IEarthquakeInformationService;
use App\Traits\Response;

class EarthquakeInformationController extends Controller
{
    use Response;

    /**
     * @var $earthquakeInformationService
     */
    private $earthquakeInformationService;

    /**
     * @param IEarthquakeInformationService $earthquakeInformationService
     */
    public function __construct(IEarthquakeInformationService $earthquakeInformationService)
    {
        $this->earthquakeInformationService = $earthquakeInformationService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $response = $this->earthquakeInformationService->getAll();
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $response = $this->earthquakeInformationService->getByCompanyIds(
            $request->companyIds
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param GetUnregisteredByCompanyIdsRequest $request
     */
    public function getUnregisteredByCompanyIds(GetUnregisteredByCompanyIdsRequest $request)
    {
        $response = $this->earthquakeInformationService->getUnregisteredByCompanyIds(
            $request->companyIds
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param CheckIfExistsRequest $request
     */
    public function checkIfExists(CheckIfExistsRequest $request)
    {
        $response = $this->earthquakeInformationService->checkIfExists(
            $request->employeeId
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $response = $this->earthquakeInformationService->getByEmployeeId(
            $request->employeeId
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $response = $this->earthquakeInformationService->create(
            $request->employeeId,
            $request->city,
            $request->address,
            $request->homeStatus,
            $request->familyHealthStatus,
            $request->workingStatus,
            $request->workingAddress,
            $request->workingDepartment,
            $request->workableDate,
            $request->computerStatus,
            $request->internetStatus,
            $request->headphoneStatus,
            $request->generalNotes
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $response = $this->earthquakeInformationService->update(
            $request->employeeId,
            $request->city,
            $request->address,
            $request->homeStatus,
            $request->familyHealthStatus,
            $request->workingStatus,
            $request->workingAddress,
            $request->workingDepartment,
            $request->workableDate,
            $request->computerStatus,
            $request->internetStatus,
            $request->headphoneStatus,
            $request->generalNotes
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }
}
