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
        if (!$employee = $this->employeeService->getByEmail($request->email)) {
            return $this->error('Employee not found', 404);
        }

        if (!checkPassword($request->password, $employee->password)) {
            return $this->error('Password is incorrect', 401);
        }

        return $this->success('Employee logged in successfully', [
            'token' => $this->employeeService->generateSanctumToken($employee)
        ]);
    }
}
