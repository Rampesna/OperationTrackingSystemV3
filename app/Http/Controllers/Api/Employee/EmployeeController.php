<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\EmployeeController\LoginRequest;
use App\Http\Requests\Api\Employee\EmployeeController\SwapThemeRequest;
use App\Http\Requests\Api\Employee\EmployeeController\GetMarketPaymentsRequest;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Traits\Response;

class EmployeeController extends Controller
{
    use Response;

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @param IEmployeeService $employeeService
     */
    public function __construct(IEmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * @param LoginRequest $request
     */
    public function login(
        LoginRequest $request
    )
    {
        $employee = $this->employeeService->getByEmail($request->email);
        if ($employee->isSuccess()) {
            if (!checkPassword($request->password, $employee->getData()->password)) {
                return $this->error('Password is incorrect', 401);
            }

            return $this->success('Employee logged in successfully', [
                'token' => $this->employeeService->generateSanctumToken($employee->getData())
            ]);
        } else {
            return $this->error(
                $employee->getMessage(),
                $employee->getStatusCode()
            );
        }
    }

    public function swapTheme(SwapThemeRequest $request)
    {
        $swapThemeResponse = $this->employeeService->swapTheme(
            $request->user()->id,
            $request->theme
        );
        if ($swapThemeResponse->isSuccess()) {
            return $this->success(
                $swapThemeResponse->getMessage(),
                $swapThemeResponse->getData(),
                $swapThemeResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $swapThemeResponse->getMessage(),
                $swapThemeResponse->getStatusCode()
            );
        }
    }

    public function getMarketPayments(GetMarketPaymentsRequest $request)
    {
        $employeeMarketPayments = $this->employeeService->getMarketPayments(
            $request->user()->id
        );
        if ($employeeMarketPayments->isSuccess()) {
            return $this->success(
                $employeeMarketPayments->getMessage(),
                $employeeMarketPayments->getData(),
                $employeeMarketPayments->getStatusCode()
            );
        } else {
            return $this->error(
                $employeeMarketPayments->getMessage(),
                $employeeMarketPayments->getStatusCode()
            );
        }
    }
}
