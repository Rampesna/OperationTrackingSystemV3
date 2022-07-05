<?php

namespace App\Interfaces\Eloquent;

interface IMarketService extends IEloquentService
{
    /**
     * @param string $code
     */
    public function getByCode(
        string $code
    );

    /**
     * @param int $employeeId
     * @param int $theme
     */
    public function swapTheme(
        int $employeeId,
        int $theme
    );

    /**
     * @param array $ids
     */
    public function getByIds(
        array $ids
    );
}
