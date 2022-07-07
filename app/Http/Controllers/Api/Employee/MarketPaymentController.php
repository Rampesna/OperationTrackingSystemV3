<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\MarketPaymentController\CreateRequest;
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

    public function create(CreateRequest $request)
    {
        return $this->success('Market payment created', $this->marketPaymentService->create(
            null,
            null,
            $request->user()->id,
            'App\Models\Eloquent\Employee',
            $request->amount,
            str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            1,
            0
        ));
    }
}
