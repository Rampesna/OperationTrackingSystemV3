<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EmployeeSkillInventoryController\GetAllRequest;
use App\Http\Requests\Api\User\EmployeeSkillInventoryController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\EmployeeSkillInventoryController\GetUnregisteredByCompanyIdsRequest;
use App\Http\Requests\Api\User\EmployeeSkillInventoryController\CheckIfExistsRequest;
use App\Http\Requests\Api\User\EmployeeSkillInventoryController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\User\EmployeeSkillInventoryController\CreateRequest;
use App\Http\Requests\Api\User\EmployeeSkillInventoryController\UpdateRequest;
use App\Interfaces\Eloquent\IEmployeeSkillInventoryService;
use App\Traits\Response;

class EmployeeSkillInventoryController extends Controller
{
    use Response;

    /**
     * @var $employeeSkillInventoryService
     */
    private $employeeSkillInventoryService;

    /**
     * @param IEmployeeSkillInventoryService $employeeSkillInventoryService
     */
    public function __construct(IEmployeeSkillInventoryService $employeeSkillInventoryService)
    {
        $this->employeeSkillInventoryService = $employeeSkillInventoryService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $response = $this->employeeSkillInventoryService->getAll();
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
        $response = $this->employeeSkillInventoryService->getByCompanyIds(
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
        $response = $this->employeeSkillInventoryService->getUnregisteredByCompanyIds(
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
        $response = $this->employeeSkillInventoryService->checkIfExists(
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
        $response = $this->employeeSkillInventoryService->getByEmployeeId(
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
        $response = $this->employeeSkillInventoryService->create(
            $request->employeeId,
            $request->centralCode,
            $request->department,
            $request->educationLevel,
            $request->get('languages'),
            $request->certificates,
            $request->jobStartDate,
            $request->products,
            $request->totalWorkExperience,
            $request->age,
            $request->gender,
            $request->hobbies,
            $request->oldWorkCompanies,
            $request->oldWorkPositions,
            $request->futureWorksTaken,
            $request->notes
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
        $response = $this->employeeSkillInventoryService->update(
            $request->employeeId,
            $request->centralCode,
            $request->department,
            $request->educationLevel,
            $request->get('languages'),
            $request->certificates,
            $request->jobStartDate,
            $request->products,
            $request->totalWorkExperience,
            $request->age,
            $request->gender,
            $request->hobbies,
            $request->oldWorkCompanies,
            $request->oldWorkPositions,
            $request->futureWorksTaken,
            $request->notes
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
