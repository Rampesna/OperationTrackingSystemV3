<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PurchaseItemController\GetByPurchaseIdRequest;
use App\Http\Requests\Api\User\PurchaseItemController\SetByPurchaseIdRequest;
use App\Http\Requests\Api\User\PurchaseItemController\SetPurchasedQuantitiesRequest;
use App\Interfaces\Eloquent\IPurchaseItemService;
use App\Traits\Response;

class PurchaseItemController extends Controller
{
    use Response;

    /**
     * @var $purchaseService
     */
    private $purchaseService;

    /**
     * @param IPurchaseItemService $purchaseService
     */
    public function __construct(IPurchaseItemService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    /**
     * @param GetByPurchaseIdRequest $request
     */
    public function getByPurchaseId(GetByPurchaseIdRequest $request)
    {
        $getByPurchaseIdResponse = $this->purchaseService->getByPurchaseId($request->purchaseId);
        if ($getByPurchaseIdResponse->isSuccess()) {
            return $this->success(
                $getByPurchaseIdResponse->getMessage(),
                $getByPurchaseIdResponse->getData(),
                $getByPurchaseIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByPurchaseIdResponse->getMessage(),
                $getByPurchaseIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetByPurchaseIdRequest $request
     */
    public function setByPurchaseId(SetByPurchaseIdRequest $request)
    {
        $setByPurchaseIdResponse = $this->purchaseService->setByPurchaseId(
            $request->purchaseId,
            $request->items
        );
        if ($setByPurchaseIdResponse->isSuccess()) {
            return $this->success(
                $setByPurchaseIdResponse->getMessage(),
                $setByPurchaseIdResponse->getData(),
                $setByPurchaseIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setByPurchaseIdResponse->getMessage(),
                $setByPurchaseIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetPurchasedQuantitiesRequest $request
     */
    public function setPurchasedQuantities(SetPurchasedQuantitiesRequest $request)
    {
        $setPurchasedQuantitiesResponse = $this->purchaseService->setPurchasedQuantities(
            $request->purchasedItems
        );
        if ($setPurchasedQuantitiesResponse->isSuccess()) {
            return $this->success(
                $setPurchasedQuantitiesResponse->getMessage(),
                $setPurchasedQuantitiesResponse->getData(),
                $setPurchasedQuantitiesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setPurchasedQuantitiesResponse->getMessage(),
                $setPurchasedQuantitiesResponse->getStatusCode()
            );
        }
    }
}
