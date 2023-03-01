<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\SpecialInformationController\GetAllRequest;
use App\Http\Requests\Api\User\SpecialInformationController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\SpecialInformationController\GetUnregisteredByCompanyIdsRequest;
use App\Http\Requests\Api\User\SpecialInformationController\CheckIfExistsRequest;
use App\Http\Requests\Api\User\SpecialInformationController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\User\SpecialInformationController\CreateRequest;
use App\Http\Requests\Api\User\SpecialInformationController\UpdateRequest;
use App\Interfaces\Eloquent\ISpecialInformationService;
use App\Traits\Response;

class SpecialInformationController extends Controller
{
    use Response;

    /**
     * @var $specialInformationService
     */
    private $specialInformationService;

    /**
     * @param ISpecialInformationService $specialInformationService
     */
    public function __construct(ISpecialInformationService $specialInformationService)
    {
        $this->specialInformationService = $specialInformationService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $response = $this->specialInformationService->getAll();
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
        $response = $this->specialInformationService->getByCompanyIds(
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
        $response = $this->specialInformationService->getUnregisteredByCompanyIds(
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
        $response = $this->specialInformationService->checkIfExists(
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
        $response = $this->specialInformationService->getByEmployeeId(
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
        $response = $this->specialInformationService->create(
            $request->employeeId,
            $request->city,
            $request->currentOffice,
            $request->address,
            $request->workingStatus,
            $request->generalStatus,
            $request->generalEquipmentStatus,
            $request->computerStatus,
            $request->internetStatus,
            $request->headphoneStatus,
            $request->workableDate,
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
        $response = $this->specialInformationService->update(
            $request->employeeId,
            $request->city,
            $request->currentOffice,
            $request->address,
            $request->workingStatus,
            $request->generalStatus,
            $request->generalEquipmentStatus,
            $request->computerStatus,
            $request->internetStatus,
            $request->headphoneStatus,
            $request->workableDate,
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
