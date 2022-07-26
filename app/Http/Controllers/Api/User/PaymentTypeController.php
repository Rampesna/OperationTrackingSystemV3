<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PaymentTypeController\GetAllRequest;
use App\Interfaces\Eloquent\IPaymentTypeService;
use App\Traits\Response;

class PaymentTypeController extends Controller
{
    use Response;

    /**
     * @var $paymentTypeService
     */
    private $paymentTypeService;

    /**
     * @param IPaymentTypeService $paymentTypeService
     */
    public function __construct(IPaymentTypeService $paymentTypeService)
    {
        $this->paymentTypeService = $paymentTypeService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->paymentTypeService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }
}
