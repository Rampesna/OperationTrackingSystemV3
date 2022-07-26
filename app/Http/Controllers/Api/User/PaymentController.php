<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PaymentController\GetAllRequest;
use App\Http\Requests\Api\User\PaymentController\GetByIdRequest;
use App\Http\Requests\Api\User\PaymentController\GetByStatusIdAndCompanyIdsRequest;
use App\Http\Requests\Api\User\PaymentController\GetByDateAndCompanyIdsRequest;
use App\Http\Requests\Api\User\PaymentController\SetStatusRequest;
use App\Http\Requests\Api\User\PaymentController\DeleteRequest;
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
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->paymentService->getAll();
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

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->paymentService->getById($request->id);
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByStatusIdAndCompanyIdsRequest $request
     */
    public function getByStatusIdAndCompanyIds(GetByStatusIdAndCompanyIdsRequest $request)
    {
        $getByStatusIdResponse = $this->paymentService->getByStatusIdAndCompanyIds(
            $request->statusId,
            $request->companyIds
        );
        if ($getByStatusIdResponse->isSuccess()) {
            return $this->success(
                $getByStatusIdResponse->getMessage(),
                $getByStatusIdResponse->getData(),
                $getByStatusIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByStatusIdResponse->getMessage(),
                $getByStatusIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByDateAndCompanyIdsRequest $request
     */
    public function getByDateAndCompanyIds(GetByDateAndCompanyIdsRequest $request)
    {
        $getByDateResponse = $this->paymentService->getByDateAndCompanyIds(
            $request->date,
            $request->companyIds
        );
        if ($getByDateResponse->isSuccess()) {
            return $this->success(
                $getByDateResponse->getMessage(),
                $getByDateResponse->getData(),
                $getByDateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByDateResponse->getMessage(),
                $getByDateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetStatusRequest $request
     */
    public function setStatus(SetStatusRequest $request)
    {
        $setStatusResponse = $this->paymentService->setStatus(
            $request->paymentId,
            $request->statusId
        );
        if ($setStatusResponse->isSuccess()) {
            return $this->success(
                $setStatusResponse->getMessage(),
                $setStatusResponse->getData(),
                $setStatusResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setStatusResponse->getMessage(),
                $setStatusResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->paymentService->delete($request->id);
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
