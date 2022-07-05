<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IMarketService;
use App\Models\Eloquent\Market;
use Illuminate\Support\Facades\Crypt;

class MarketService implements IMarketService
{
    public function getAll()
    {
        return Market::all();
    }

    public function getById(
        int $id
    )
    {
        return Market::find($id);
    }

    public function getByIds(
        array $ids
    )
    {
        return Market::whereIn('id', $ids)->get();
    }

    public function getByCode(
        string $code
    )
    {
        return Market::where('code', $code)->first();
    }

    public function swapTheme(
        int $marketId,
        int $theme
    )
    {
        $market = $this->getById($marketId);

        if (!$market) {
            return false;
        }

        $market->theme = $theme;
        $market->save();

        return $market;
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

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }
}
