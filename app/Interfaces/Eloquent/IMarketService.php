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
    );

    /**
     * @param int $employeeId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $employeeId,
        int $theme
    );

    /**
     * @param array $ids
     *
     * @return ServiceResponse
     */
    public function getByIds(
        array $ids
    );

    /**
     * @param int $marketId
     *
     * @return ServiceResponse
     */
    public function getMarketPayments(
        int $marketId
    );
}
