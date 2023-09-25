<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\MarketPaymentController\CreateRequest;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IMarketPaymentService;
use App\Traits\Response;

class MarketPaymentController extends Controller
{
    use Response;

    /**
     * @var $marketPaymentService
     */
    private $marketPaymentService;

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @param IMarketPaymentService $marketPaymentService
     * @param IEmployeeService $employeeService
     */
    public function __construct(
        IMarketPaymentService $marketPaymentService,
        IEmployeeService      $employeeService
    )
    {
        $this->marketPaymentService = $marketPaymentService;
        $this->employeeService = $employeeService;
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $employee = $this->employeeService->getById($request->user()->id);
        if ($employee->isSuccess()) {
            if ($employee->getData()->suspend == 1) {
                return $this->error(
                    'Your account is suspended',
                    403
                );
            } else {
                $createResponse = $this->marketPaymentService->create(
                    null,
                    null,
                    $request->user()->id,
                    'App\Models\Eloquent\Employee',
                    $request->amount,
                    str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT),
                    1,
                    0
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
        } else {
            return $this->error(
                $employee->getMessage(),
                $employee->getStatusCode()
            );
        }
    }
}
