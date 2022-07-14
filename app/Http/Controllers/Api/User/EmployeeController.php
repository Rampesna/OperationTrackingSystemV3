<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EmployeeController\CreateRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByCompaniesRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByJobDepartmentTypeIdsRequest;
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
     * @param GetByCompaniesRequest $request
     */
    public function getByCompanyIds(GetByCompaniesRequest $request)
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
            $request->leave
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
