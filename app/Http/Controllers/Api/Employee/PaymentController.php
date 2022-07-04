<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\PaymentController\GetDateBetweenRequest;
use App\Http\Requests\Api\Employee\PaymentController\CreateRequest;
use App\Interfaces\Eloquent\IPaymentService;
use App\Traits\Response;

class PaymentController extends Controller
{
    use Response;

    private $paymentService;

    public function __construct(IPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function getDateBetween(GetDateBetweenRequest $request)
    {
        return $this->success('Employee payments', $this->paymentService->getDateBetween(
            $request->user()->id,
            $request->startDate,
            $request->endDate
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Payment created', $this->paymentService->create(
            $request->user()->id,
            $request->typeId,
            1,
            $request->date,
            $request->amount,
            $request->description
        ));
    }
}
