<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IMarketService extends IEloquentService
{
    /**
     * @param string $code
     *
     * @return ServiceResponse
     */
    public function getByCode(
        string $code
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getProfile(
        int $id
    ): ServiceResponse;

    /**
     * @param int $marketId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $marketId,
        int $theme
    ): ServiceResponse;

    /**
     * @param array $ids
     *
     * @return ServiceResponse
     */
    public function getByIds(
        array $ids
    ): ServiceResponse;

    /**
     * @param int $marketId
     *
     * @return ServiceResponse
     */
    public function getMarketPayments(
        int $marketId
    ): ServiceResponse;
}
