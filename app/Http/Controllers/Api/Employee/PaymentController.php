<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\PaymentController\GetDateBetweenRequest;
use App\Http\Requests\Api\Employee\PaymentController\GetByIdRequest;
use App\Http\Requests\Api\Employee\PaymentController\CreateRequest;
use App\Http\Requests\Api\Employee\PaymentController\UpdateRequest;
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

    public function getById(GetByIdRequest $request)
    {
        $payment = $this->paymentService->getById(
            $request->id
        );

        if (!$payment || $payment->employee_id != $request->user()->id) {
            return $this->error('Payment not found', 404);
        }

        return $this->success('Employee payment', $payment);
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

    public function update(UpdateRequest $request)
    {
        $payment = $this->paymentService->getById(
            $request->id
        );

        if (!$payment || $payment->employee_id != $request->user()->id) {
            return $this->error('Payment not found', 404);
        }

        if ($payment->status_id != 1) {
            return $this->error('You can not update payment with status other than pending', 403);
        }

        return $this->success('Payment updated', $this->paymentService->update(
            $request->id,
            $request->user()->id,
            $request->typeId,
            1,
            $request->date,
            $request->amount,
            $request->description
        ));
    }
}
