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
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getProfile(
        int $id
    ): ServiceResponse
    {
        $market = Market::find($id);
        if ($market) {
            return new ServiceResponse(
                true,
                'Market',
                200,
                [
                    'id' => $market->id,
                    'name' => $market->name,
                    'code' => $market->code,
                    'image' => $market->image,
                    'device_token' => $market->device_token,
                ]
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
     * @param string $name
     * @param string $code
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function register(
        string $name,
        string $code,
        string $password
    ): ServiceResponse
    {
        $market = new Market;
        $market->code = $code;
        $market->name = $name;
        $market->password = bcrypt($password);
        $market->suspended = 0;
        $market->save();

        return new ServiceResponse(
            true,
            'Market registered',
            201,
            $market
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
            return $market;
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
                $market->getData()->marketPayments
            );
        } else {
            return $market;
        }
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword
    ): ServiceResponse
    {
        $markets = Market::with([]);

        if ($keyword) {
            $markets->where(function ($markets) use ($keyword) {
                $markets->where('code', 'like', '%' . $keyword . '%')->orWhere('name', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Markets',
            200,
            [
                'totalCount' => $markets->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'markets' => $markets->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()->append('balance')
            ]
        );
    }

    /**
     * @param string $code
     * @param string $name
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function create(
        string $code,
        string $name,
        string $password
    ): ServiceResponse
    {
        $market = new Market();
        $market->code = $code;
        $market->name = $name;
        $market->password = bcrypt($password);
        $market->save();
        return new ServiceResponse(
            true,
            'Market created',
            201,
            $market
        );
    }

    /**
     * @param int $id
     * @param string $code
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $code,
        string $name
    ): ServiceResponse
    {
        $market = $this->getById($id);
        if ($market->isSuccess()) {
            $market->getData()->code = $code;
            $market->getData()->name = $name;
            $market->getData()->save();
            return new ServiceResponse(
                true,
                'Market updated',
                200,
                $market->getData()
            );
        } else {
            return $market;
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
        return $market;
    }
}
