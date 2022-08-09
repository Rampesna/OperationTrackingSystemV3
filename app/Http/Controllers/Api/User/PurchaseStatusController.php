<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PurchaseStatusController\GetAllRequest;
use App\Interfaces\Eloquent\IPurchaseStatusService;
use App\Traits\Response;

class PurchaseStatusController extends Controller
{
    use Response;

    /**
     * @var $purchaseStatusService
     */
    private $purchaseStatusService;

    /**
     * @param IPurchaseStatusService $purchaseStatusService
     */
    public function __construct(IPurchaseStatusService $purchaseStatusService)
    {
        $this->purchaseStatusService = $purchaseStatusService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->purchaseStatusService->getAll();
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
