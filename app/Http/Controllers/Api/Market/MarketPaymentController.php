<?php

namespace App\Http\Controllers\Api\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Market\MarketPaymentController\GetByCodeRequest;
use App\Http\Requests\Api\Market\MarketPaymentController\SetCompletedRequest;
use App\Interfaces\Eloquent\IMarketPaymentService;
use App\Traits\Response;

class MarketPaymentController extends Controller
{
    use Response;

    /**
     * @var $marketPaymentService
     */
    private $marketPaymentService;

    /**
     * @param IMarketPaymentService $marketPaymentService
     */
    public function __construct(IMarketPaymentService $marketPaymentService)
    {
        $this->marketPaymentService = $marketPaymentService;
    }

    /**
     * @param GetByCodeRequest $request
     */
    public function getByCode(GetByCodeRequest $request)
    {
        $marketPayment = $this->marketPaymentService->getByCode($request->code);

        if ($marketPayment->isSuccess()) {
            return $this->success(
                $marketPayment->getMessage(),
                $marketPayment->getData(),
                $marketPayment->getStatusCode()
            );
        } else {
            return $this->error(
                $marketPayment->getMessage(),
                $marketPayment->getStatusCode()
            );
        }
    }

    /**
     * @param SetCompletedRequest $request
     */
    public function setCompleted(SetCompletedRequest $request)
    {
        $marketPayment = $this->marketPaymentService->getByCode($request->code);

        if ($marketPayment->isSuccess()) {
            if (!$marketPayment->getData() || $marketPayment->getData()->completed == 1) {
                return $this->error('Market payment not found', 404);
            }

            if ($marketPayment->getData()->relation->getBalanceAttribute() < $marketPayment->getData()->amount) {
                return $this->error('Not enough money', 406);
            }

            $setCompletedResponse = $this->marketPaymentService->setCompleted(
                $request->user()->id,
                $marketPayment->getData()->id,
            );

            if ($setCompletedResponse->isSuccess()) {
                return $this->success(
                    $setCompletedResponse->getMessage(),
                    $setCompletedResponse->getData(),
                    $setCompletedResponse->getStatusCode()
                );
            } else {
                return $this->error(
                    $setCompletedResponse->getMessage(),
                    $setCompletedResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $marketPayment->getMessage(),
                $marketPayment->getStatusCode()
            );
        }
    }
}
