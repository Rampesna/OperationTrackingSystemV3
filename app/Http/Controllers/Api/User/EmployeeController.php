<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EmployeeController\GetAllWorkersRequest;
use App\Http\Requests\Api\User\EmployeeController\CreateRequest;
use App\Http\Requests\Api\User\EmployeeController\UpdateRequest;
use App\Http\Requests\Api\User\EmployeeController\LeaveRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByCompanyIdsWithPersonalInformationRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByCompanyIdsWithBalanceRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByCompanyIdsWithDevicesRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByJobDepartmentTypeIdsRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByIdRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByEmailRequest;
use App\Http\Requests\Api\User\EmployeeController\UpdateJobDepartmentRequest;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IJobDepartmentService;
use App\Traits\Response;

class EmployeeController extends Controller
{
    use Response;

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @var $jobDepartmentService
     */
    public function __construct(IEmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * @param GetAllWorkersRequest $request
     */
    public function getAllWorkers(GetAllWorkersRequest $request)
    {
        $getAllWorkersResponse = $this->employeeService->getAllWorkers();
        if ($getAllWorkersResponse->isSuccess()) {
            return $this->success(
                $getAllWorkersResponse->getMessage(),
                $getAllWorkersResponse->getData(),
                $getAllWorkersResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllWorkersResponse->getMessage(),
                $getAllWorkersResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (count($request->companyIds) == 0) return $this->error('Minimum one company is required.', 404);

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        $getByCompaniesResponse = $this->employeeService->getByCompanyIds(
            $request->pageIndex,
            $request->pageSize,
            $request->companyIds,
            $request->leave,
            $request->keyword
        );
        if ($getByCompaniesResponse->isSuccess()) {
            return $this->success(
                $getByCompaniesResponse->getMessage(),
                $getByCompaniesResponse->getData(),
                $getByCompaniesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompaniesResponse->getMessage(),
                $getByCompaniesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByCompanyIdsWithPersonalInformationRequest $request
     */
    public function getByCompanyIdsWithPersonalInformation(GetByCompanyIdsWithPersonalInformationRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (count($request->companyIds) == 0) return $this->error('Minimum one company is required.', 404);

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        $getByCompanyIdsWithPersonalInformationResponse = $this->employeeService->getByCompanyIdsWithPersonalInformation(
            $request->pageIndex,
            $request->pageSize,
            $request->companyIds,
            $request->leave
        );
        if ($getByCompanyIdsWithPersonalInformationResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdsWithPersonalInformationResponse->getMessage(),
                $getByCompanyIdsWithPersonalInformationResponse->getData(),
                $getByCompanyIdsWithPersonalInformationResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdsWithPersonalInformationResponse->getMessage(),
                $getByCompanyIdsWithPersonalInformationResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByCompanyIdsWithBalanceRequest $request
     */
    public function getByCompanyIdsWithBalance(GetByCompanyIdsWithBalanceRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (count($request->companyIds) == 0) return $this->error('Minimum one company is required.', 404);

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        $getByCompanyIdsWithBalanceResponse = $this->employeeService->getByCompanyIdsWithBalance(
            $request->pageIndex,
            $request->pageSize,
            $request->companyIds,
            $request->leave
        );
        if ($getByCompanyIdsWithBalanceResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdsWithBalanceResponse->getMessage(),
                $getByCompanyIdsWithBalanceResponse->getData(),
                $getByCompanyIdsWithBalanceResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdsWithBalanceResponse->getMessage(),
                $getByCompanyIdsWithBalanceResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByCompanyIdsWithDevicesRequest $request
     */
    public function getByCompanyIdsWithDevices(GetByCompanyIdsWithDevicesRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (count($request->companyIds) == 0) return $this->error('Minimum one company is required.', 404);

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        $getByCompanyIdsWithDevicesResponse = $this->employeeService->getByCompanyIdsWithDevices(
            $request->pageIndex,
            $request->pageSize,
            $request->companyIds,
            $request->leave
        );
        if ($getByCompanyIdsWithDevicesResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdsWithDevicesResponse->getMessage(),
                $getByCompanyIdsWithDevicesResponse->getData(),
                $getByCompanyIdsWithDevicesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdsWithDevicesResponse->getMessage(),
                $getByCompanyIdsWithDevicesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByJobDepartmentTypeIdsRequest $request
     * @param IJobDepartmentService $jobDepartmentService
     */
    public function getByJobDepartmentTypeIds(
        GetByJobDepartmentTypeIdsRequest $request,
        IJobDepartmentService            $jobDepartmentService
    )
    {
        $jobDepartments = $jobDepartmentService->getByTypeIds($request->jobDepartmentTypeIds);
        if ($jobDepartments->isSuccess()) {
            $employees = collect();

            foreach ($jobDepartments->getData() as $jobDepartment) {
                $employees = $employees->merge($jobDepartment->employees);
            }

            return $this->success('Employees', $employees);
        } else {
            return $this->error(
                $jobDepartments->getMessage(),
                $jobDepartments->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->employeeService->getById($request->id);
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
     * @param GetByEmailRequest $request
     */
    public function getByEmail(GetByEmailRequest $request)
    {
        $getByEmailResponse = $this->employeeService->getByEmail($request->email);
        if ($getByEmailResponse->isSuccess()) {
            return $this->success(
                $getByEmailResponse->getMessage(),
                $getByEmailResponse->getData(),
                $getByEmailResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByEmailResponse->getMessage(),
                $getByEmailResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        if (!in_array($request->companyId, $request->user()->companies->pluck('id')->toArray())) {
            return $this->error('Unauthorized', 401);
        }

        $createResponse = $this->employeeService->create(
            $request->guid,
            $request->companyId,
            $request->roleId,
            $request->jobDepartmentId,
            $request->name,
            $request->email,
            $request->phone,
            $request->identity,
            $request->santralCode,
            $request->password
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
        $updateResponse = $this->employeeService->update(
            $request->id,
            $request->name,
            $request->email,
            $request->phone,
            $request->identity,
            $request->santralCode,
            $request->saturdayPermitExemption
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
     * @param LeaveRequest $request
     */
    public function leave(LeaveRequest $request)
    {
        $leaveResponse = $this->employeeService->leave(
            $request->employeeId,
            $request->employeeGuid,
            $request->date,
            $request->leavingReasonId
        );
        if ($leaveResponse->isSuccess()) {
            return $this->success(
                $leaveResponse->getMessage(),
                $leaveResponse->getData(),
                $leaveResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $leaveResponse->getMessage(),
                $leaveResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateJobDepartmentRequest $request
     */
    public function updateJobDepartment(UpdateJobDepartmentRequest $request)
    {
        $updateJobDepartmentResponse = $this->employeeService->updateJobDepartment(
            $request->employeeId,
            $request->jobDepartmentId
        );
        if ($updateJobDepartmentResponse->isSuccess()) {
            return $this->success(
                $updateJobDepartmentResponse->getMessage(),
                $updateJobDepartmentResponse->getData(),
                $updateJobDepartmentResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateJobDepartmentResponse->getMessage(),
                $updateJobDepartmentResponse->getStatusCode()
            );
        }
    }
}
