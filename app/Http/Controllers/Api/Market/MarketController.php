<?php

namespace App\Http\Controllers\Api\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Market\MarketController\LoginRequest;
use App\Http\Requests\Api\Market\MarketController\SwapThemeRequest;
use App\Interfaces\Eloquent\IMarketService;
use App\Traits\Response;

class MarketController extends Controller
{
    use Response;

    private $marketService;

    public function __construct(IMarketService $marketService)
    {
        $this->marketService = $marketService;
    }

    /**
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        if (!$market = $this->marketService->getByCode($request->code)) {
            return $this->error('Market not found', 404);
        }

        if (!checkPassword($request->password, $market->password)) {
            return $this->error('Password is incorrect', 401);
        }

        return $this->success('Market logged in successfully', [
            'token' => $this->marketService->generateSanctumToken($market)
        ]);
    }

    public function swapTheme(SwapThemeRequest $request)
    {
        return $this->success('Theme swapped successfully', $this->marketService->swapTheme(
            $request->user()->id,
            $request->theme
        ));
    }
}
