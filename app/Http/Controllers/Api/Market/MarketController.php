<?php

namespace App\Http\Controllers\Api\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Market\MarketController\LoginRequest;
use App\Http\Requests\Api\Market\MarketController\SwapThemeRequest;
use App\Http\Requests\Api\Market\MarketController\GetMarketPaymentsRequest;
use App\Interfaces\Eloquent\IMarketService;
use App\Traits\Response;

class MarketController extends Controller
{
    use Response;

    /**
     * @var $marketService
     */
    private $marketService;

    /**
     * @param IMarketService $marketService
     */
    public function __construct(IMarketService $marketService)
    {
        $this->marketService = $marketService;
    }

    /**
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        $market = $this->marketService->getByCode($request->code);
        if ($market->isSuccess()) {
            if (!checkPassword($request->password, $market->getData()->password)) {
                return $this->error('Password is incorrect', 401);
            }

            return $this->success('Market logged in successfully', [
                'token' => $this->marketService->generateSanctumToken($market->getData())
            ]);
        } else {
            return $this->error(
                $market->getMessage(),
                $market->getStatusCode()
            );
        }
    }

    /**
     * @param SwapThemeRequest $request
     */
    public function swapTheme(SwapThemeRequest $request)
    {
        $swapThemeResponse = $this->marketService->swapTheme(
            $request->user()->id,
            $request->theme
        );
        if ($swapThemeResponse->isSuccess()) {
            return $this->success(
                $swapThemeResponse->getMessage(),
                $swapThemeResponse->getData(),
                $swapThemeResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $swapThemeResponse->getMessage(),
                $swapThemeResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetMarketPaymentsRequest $request
     */
    public function getMarketPayments(GetMarketPaymentsRequest $request)
    {
        $getMarketPaymentsResponse = $this->marketService->getMarketPayments(
            $request->user()->id
        );
        if ($getMarketPaymentsResponse->isSuccess()) {
            return $this->success(
                $getMarketPaymentsResponse->getMessage(),
                $getMarketPaymentsResponse->getData(),
                $getMarketPaymentsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getMarketPaymentsResponse->getMessage(),
                $getMarketPaymentsResponse->getStatusCode()
            );
        }
    }
}
