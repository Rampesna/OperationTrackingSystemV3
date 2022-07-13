<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IMarketService;
use App\Models\Eloquent\Market;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\Crypt;

class MarketService implements IMarketService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All markets',
            200,
            Market::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $market = Market::find($id);
        if ($market) {
            return new ServiceResponse(
                true,
                'Market',
                200,
                $market
            );
        }
        return new ServiceResponse(
            false,
            'Market not found',
            404,
            null
        );
    }

    /**
     * @param array $ids
     *
     * @return ServiceResponse
     */
    public function getByIds(
        array $ids
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Markets',
            200,
            Market::whereIn('id', $ids)->get()
        );
    }

    /**
     * @param string $code
     *
     * @return ServiceResponse
     */
    public function getByCode(
        string $code
    ): ServiceResponse
    {
        $market = Market::where('code', $code)->first();
        if ($market) {
            return new ServiceResponse(
                true,
                'Market',
                200,
                $market
            );
        }
        return new ServiceResponse(
            false,
            'Market not found',
            404,
            null
        );
    }

    /**
     * @param int $marketId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $marketId,
        int $theme
    ): ServiceResponse
    {
        $market = $this->getById($marketId);
        if ($market->isSuccess()) {
            $market->getData()->theme = $theme;
            $market->getData()->save();

            return new ServiceResponse(
                true,
                'Market theme swapped',
                200,
                $market->getData()
            );
        } else {
            return new ServiceResponse(
                false,
                'Market not found',
                404,
                null
            );
        }
    }

    public function generateSanctumToken(
        Market $market
    )
    {
        $token = $market->createToken('marketApiToken')->plainTextToken;

        $market->api_token = $token;
        $market->save();

        return $token;
    }

    public function generateOAuthToken(
        Market $market
    )
    {
        return Crypt::encrypt($market->id);
    }

    /**
     * @param int $marketId
     *
     * @return ServiceResponse
     */
    public function getMarketPayments(
        int $marketId
    ): ServiceResponse
    {
        $market = $this->getById($marketId);
        if ($market->isSuccess()) {
            return new ServiceResponse(
                true,
                'Market payments',
                200,
                $market->getData()->payments
            );
        } else {
            return new ServiceResponse(
                false,
                'Market not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $market = $this->getById($id);
        if ($market->isSuccess()) {
            return new ServiceResponse(
                true,
                'Market deleted',
                200,
                $market->getData()->delete()
            );
        }
        return new ServiceResponse(
            false,
            'Market not found',
            404,
            null
        );
    }
}
