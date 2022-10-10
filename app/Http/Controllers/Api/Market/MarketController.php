<?php

namespace App\Http\Controllers\Api\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Market\MarketController\RegisterRequest;
use App\Http\Requests\Api\Market\MarketController\LoginRequest;
use App\Http\Requests\Api\Market\MarketController\GetProfileRequest;
use App\Http\Requests\Api\Market\MarketController\SwapThemeRequest;
use App\Http\Requests\Api\Market\MarketController\SetDeviceTokenRequest;
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
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        $registerResponse = $this->marketService->register(
            $request->name,
            $request->code,
            $request->password
        );
        if ($registerResponse->isSuccess()) {
            return $this->success(
                $registerResponse->getMessage(),
                $registerResponse->getData(),
                $registerResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $registerResponse->getMessage(),
                $registerResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetProfileRequest $request
     */
    public function getProfile(GetProfileRequest $request)
    {
        $getProfileResponse = $this->marketService->getProfile(
            $request->user()->id
        );
        if ($getProfileResponse->isSuccess()) {
            return $this->success(
                $getProfileResponse->getMessage(),
                $getProfileResponse->getData(),
                $getProfileResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getProfileResponse->getMessage(),
                $getProfileResponse->getStatusCode()
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
     * @param SetDeviceTokenRequest $request
     */
    public function setDeviceToken(SetDeviceTokenRequest $request)
    {
        $setDeviceTokenResponse = $this->marketService->setDeviceToken(
            $request->user()->id,
            $request->deviceToken
        );
        if ($setDeviceTokenResponse->isSuccess()) {
            return $this->success(
                $setDeviceTokenResponse->getMessage(),
                $setDeviceTokenResponse->getData(),
                $setDeviceTokenResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setDeviceTokenResponse->getMessage(),
                $setDeviceTokenResponse->getStatusCode()
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
