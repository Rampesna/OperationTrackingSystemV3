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

    /**
     * @var $paymentService
     */
    private $paymentService;

    /**
     * @param IPaymentService $paymentService
     */
    public function __construct(IPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * @param GetDateBetweenRequest $request
     */
    public function getDateBetween(GetDateBetweenRequest $request)
    {
        $getDateBetweenResponse = $this->paymentService->getDateBetween(
            $request->user()->id,
            $request->startDate,
            $request->endDate
        );
        if ($getDateBetweenResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenResponse->getMessage(),
                $getDateBetweenResponse->getData(),
                $getDateBetweenResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenResponse->getMessage(),
                $getDateBetweenResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $payment = $this->paymentService->getById(
            $request->id
        );
        if ($payment->isSuccess()) {
            if (!$payment->getData() || $payment->getData()->employee_id != $request->user()->id) {
                return $this->error('Payment not found', 404);
            }

            return $this->success(
                $payment->getMessage(),
                $payment->getData(),
                $payment->getStatusCode()
            );
        } else {
            return $this->error(
                $payment->getMessage(),
                $payment->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->paymentService->create(
            $request->user()->id,
            $request->typeId,
            1,
            $request->date,
            $request->amount,
            $request->description
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

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $payment = $this->paymentService->getById(
            $request->id
        );
        if ($payment->isSuccess()) {
            if (!$payment->getData() || $payment->getData()->employee_id != $request->user()->id) {
                return $this->error('Payment not found', 404);
            }

            if ($payment->getData()->status_id != 1) {
                return $this->error('You can not update payment with status other than pending', 403);
            }

            $updateResponse = $this->paymentService->update(
                $request->id,
                $request->user()->id,
                $request->typeId,
                1,
                $request->date,
                $request->amount,
                $request->description
            );
            if ($updateResponse->isSuccess()) {
                return $this->success(
                    $updateResponse->getMessage(),
                    $updateResponse->getData(),
                    $updateResponse->getStatusCode()
                );
            } else {
                return $this->error(
                    $updateResponse->getMessage(),
                    $updateResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $payment->getMessage(),
                $payment->getStatusCode()
            );
        }
    }
}
