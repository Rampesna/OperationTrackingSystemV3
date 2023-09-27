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
     * @param IMarketPaymentService $marketPaymentService
     */
    public function __construct(IMarketPaymentService $marketPaymentService,)
    {
        $this->marketPaymentService = $marketPaymentService;
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
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
}
