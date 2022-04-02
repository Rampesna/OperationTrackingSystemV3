<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EmployeeController\IndexRequest;
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

    public function index(IndexRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        return $this->employeeService->index(
            $request->keyword,
            $request->pageIndex,
            $request->pageSize,
            $request->companyIds,
            $request->leave
        );
    }
}
