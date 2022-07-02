<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\EmployeeController\LoginRequest;
use App\Http\Requests\Api\Employee\EmployeeController\SwapThemeRequest;
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

    public function swapTheme(SwapThemeRequest $request)
    {
        return $this->success('Theme swapped successfully', $this->employeeService->swapTheme(
            $request->user()->id,
            $request->theme
        ));
    }
}
