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

    private $marketPaymentService;

    public function __construct(IMarketPaymentService $marketPaymentService)
    {
        $this->marketPaymentService = $marketPaymentService;
    }

    public function getByCode(GetByCodeRequest $request)
    {
        $marketPayment = $this->marketPaymentService->getByCode($request->code);

        if (!$marketPayment) {
            return $this->error('Market payment not found', 404);
        }

        return $this->success('Market payment', $marketPayment);
    }

    public function setCompleted(SetCompletedRequest $request)
    {
        $marketPayment = $this->marketPaymentService->getByCode($request->code);

        if (!$marketPayment || $marketPayment->completed == 1) {
            return $this->error('Market payment not found', 404);
        }

        if ($marketPayment->relation->getBalanceAttribute() < $marketPayment->amount) {
            return $this->error('Not enough money', 406);
        }

        return $this->success('Set market payment completed', $this->marketPaymentService->setCompleted(
            $marketPayment->id
        ));
    }
}
