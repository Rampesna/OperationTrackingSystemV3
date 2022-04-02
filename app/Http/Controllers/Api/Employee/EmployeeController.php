<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\EmployeeController\LoginRequest;
use App\Interfaces\Eloquent\IEmployeeService;

class EmployeeController extends Controller
{
    private $employeeService;

    public function __construct(IEmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        return $this->employeeService->login(
            $request->email,
            $request->password
        );
    }
}
