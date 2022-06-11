<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EmployeeController\CreateRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByCompaniesRequest;
use App\Http\Requests\Api\User\EmployeeController\GetByEmailRequest;
use App\Http\Requests\Api\User\EmployeeController\UpdateJobDepartmentRequest;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Traits\Response;

class EmployeeController extends Controller
{
    use Response;

    private $employeeService;

    public function __construct(IEmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function getByCompanies(GetByCompaniesRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        return $this->success('Users', $this->employeeService->getByCompanies(
            $request->pageIndex,
            $request->pageSize,
            $request->companyIds,
            $request->leave
        ));
    }

    public function getByEmail(GetByEmailRequest $request)
    {
        return $this->success('Employee', $this->employeeService->getByEmail($request->email));
    }

    public function create(CreateRequest $request)
    {
        if (!in_array($request->companyId, $request->user()->companies->pluck('id')->toArray())) {
            return $this->error('Unauthorized', 401);
        }

        return $this->success('Employee created successfully', $this->employeeService->create(
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
        ));
    }

    public function updateJobDepartment(UpdateJobDepartmentRequest $request)
    {
        return $this->success('Employee job department updated', $this->employeeService->updateJobDepartment(
            $request->employeeId,
            $request->jobDepartmentId
        ));
    }
}
