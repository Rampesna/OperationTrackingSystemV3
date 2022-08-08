<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\MarketPaymentController\AddBalanceEmployeesRequest;
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
     * @param IMarketPaymentService $marketPaymentService
     */
    public function __construct(IMarketPaymentService $marketPaymentService)
    {
        $this->marketPaymentService = $marketPaymentService;
    }

    /**
     * @param AddBalanceEmployeesRequest $request
     */
    public function addBalanceEmployees(AddBalanceEmployeesRequest $request)
    {
        foreach ($request->employeeIds as $employeeId) {
            $createResponse = $this->marketPaymentService->create(
                null,
                null,
                $employeeId,
                'App\Models\Eloquent\Employee',
                $request->amount,
                null,
                0,
                1
            );
            if ($createResponse->isSuccess()) {
                continue;
            } else {
                return $this->error(
                    $createResponse->getMessage(),
                    $createResponse->getStatusCode()
                );
            }
        }

        return $this->success(
            $createResponse->getMessage(),
            $createResponse->getData(),
            $createResponse->getStatusCode()
        );
    }
}
