<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PurchaseController\GetAllRequest;
use App\Http\Requests\Api\User\PurchaseController\GetAllPaginateRequest;
use App\Http\Requests\Api\User\PurchaseController\GetByIdRequest;
use App\Http\Requests\Api\User\PurchaseController\GetByUserIdRequest;
use App\Http\Requests\Api\User\PurchaseController\CreateRequest;
use App\Http\Requests\Api\User\PurchaseController\UpdateRequest;
use App\Http\Requests\Api\User\PurchaseController\UpdatePurchaserRequest;
use App\Http\Requests\Api\User\PurchaseController\SendForAcceptRequest;
use App\Http\Requests\Api\User\PurchaseController\AcceptRequest;
use App\Http\Requests\Api\User\PurchaseController\DeleteRequest;
use App\Interfaces\Eloquent\IPurchaseService;
use App\Traits\Response;

class PurchaseController extends Controller
{
    use Response;

    /**
     * @var $purchaseService
     */
    private $purchaseService;

    /**
     * @param IPurchaseService $purchaseService
     */
    public function __construct(IPurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->purchaseService->getAll();
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
     * @param GetAllPaginateRequest $request
     */
    public function getAllPaginate(GetAllPaginateRequest $request)
    {
        $getAllPaginateResponse = $this->purchaseService->getAllPaginate(
            $request->pageIndex,
            $request->pageSize,
            $request->statusId,
            $request->keyword
        );
        if ($getAllPaginateResponse->isSuccess()) {
            return $this->success(
                $getAllPaginateResponse->getMessage(),
                $getAllPaginateResponse->getData(),
                $getAllPaginateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllPaginateResponse->getMessage(),
                $getAllPaginateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->purchaseService->getById($request->id);
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
     * @param GetByUserIdRequest $request
     */
    public function getByUserId(GetByUserIdRequest $request)
    {
        $getByUserIdResponse = $this->purchaseService->getByUserId(
            $request->user()->id,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword,
            $request->statusId
        );
        if ($getByUserIdResponse->isSuccess()) {
            return $this->success(
                $getByUserIdResponse->getMessage(),
                $getByUserIdResponse->getData(),
                $getByUserIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByUserIdResponse->getMessage(),
                $getByUserIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->purchaseService->create(
            $request->user()->id,
            $request->statusId,
            $request->name,
            $request->deliveryDate,
            $request->receiptNumber,
            $request->price
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
        $updateResponse = $this->purchaseService->update(
            $request->id,
            $request->statusId,
            $request->name,
            $request->deliveryDate,
            $request->receiptNumber,
            $request->price
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
     * @param UpdatePurchaserRequest $request
     */
    public function updatePurchaser(UpdatePurchaserRequest $request)
    {
        $updatePurchaserResponse = $this->purchaseService->updatePurchaser(
            $request->id,
            $request->purchaserId
        );
        if ($updatePurchaserResponse->isSuccess()) {
            return $this->success(
                $updatePurchaserResponse->getMessage(),
                $updatePurchaserResponse->getData(),
                $updatePurchaserResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updatePurchaserResponse->getMessage(),
                $updatePurchaserResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SendForAcceptRequest $request
     */
    public function sendForAccept(SendForAcceptRequest $request)
    {
        $sendForAcceptResponse = $this->purchaseService->sendForAccept(
            $request->id,
            $request->receiptNumber,
            $request->price
        );
        if ($sendForAcceptResponse->isSuccess()) {
            return $this->success(
                $sendForAcceptResponse->getMessage(),
                $sendForAcceptResponse->getData(),
                $sendForAcceptResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $sendForAcceptResponse->getMessage(),
                $sendForAcceptResponse->getStatusCode()
            );
        }
    }

    /**
     * @param AcceptRequest $request
     */
    public function accept(AcceptRequest $request)
    {
        $acceptResponse = $this->purchaseService->accept(
            $request->id
        );
        if ($acceptResponse->isSuccess()) {
            return $this->success(
                $acceptResponse->getMessage(),
                $acceptResponse->getData(),
                $acceptResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $acceptResponse->getMessage(),
                $acceptResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->purchaseService->delete($request->id);
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
