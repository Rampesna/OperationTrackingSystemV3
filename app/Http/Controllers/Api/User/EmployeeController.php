<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EmployeeController\GetByCompaniesRequest;
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
}
