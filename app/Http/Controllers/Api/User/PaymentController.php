<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PaymentController\GetAllRequest;
use App\Http\Requests\Api\User\PaymentController\GetByIdRequest;
use App\Http\Requests\Api\User\PaymentController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\PaymentController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\User\PaymentController\GetByStatusIdAndCompanyIdsRequest;
use App\Http\Requests\Api\User\PaymentController\GetDateBetweenAndCompanyIdsRequest;
use App\Http\Requests\Api\User\PaymentController\GetByDateAndCompanyIdsRequest;
use App\Http\Requests\Api\User\PaymentController\CreateRequest;
use App\Http\Requests\Api\User\PaymentController\UpdateRequest;
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
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $getByCompanyIdsResponse = $this->paymentService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword,
            $request->date,
            $request->amount,
            $request->statusId,
            $request->typeId
        );
        if ($getByCompanyIdsResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getData(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $getByEmployeeIdResponse = $this->paymentService->getByEmployeeId(
            $request->employeeId,
            $request->pageIndex,
            $request->pageSize,
            $request->date,
            $request->amount,
            $request->statusId,
            $request->typeId
        );
        if ($getByEmployeeIdResponse->isSuccess()) {
            return $this->success(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getData(),
                $getByEmployeeIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getStatusCode()
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
     * @param GetDateBetweenAndCompanyIdsRequest $request
     */
    public function getDateBetweenAndCompanyIds(GetDateBetweenAndCompanyIdsRequest $request)
    {
        $getDateBetweenAndCompanyIdsResponse = $this->paymentService->getDateBetweenAndCompanyIds(
            $request->companyIds,
            $request->startDate,
            $request->endDate
        );
        if ($getDateBetweenAndCompanyIdsResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenAndCompanyIdsResponse->getMessage(),
                $getDateBetweenAndCompanyIdsResponse->getData(),
                $getDateBetweenAndCompanyIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenAndCompanyIdsResponse->getMessage(),
                $getDateBetweenAndCompanyIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->paymentService->create(
            $request->employeeId,
            $request->typeId,
            $request->statusId,
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
        $updateResponse = $this->paymentService->update(
            $request->id,
            $request->employeeId,
            $request->typeId,
            $request->statusId,
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
