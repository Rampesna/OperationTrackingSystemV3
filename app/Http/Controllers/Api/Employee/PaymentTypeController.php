<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\PaymentTypeController\GetAllRequest;
use App\Interfaces\Eloquent\IPaymentTypeService;
use App\Traits\Response;

class PaymentTypeController extends Controller
{
    use Response;

    private $paymentTypeService;

    public function __construct(IPaymentTypeService $paymentTypeService)
    {
        $this->paymentTypeService = $paymentTypeService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('Employee paymentTypes', $this->paymentTypeService->getAll());
    }
}
