<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IBoardService extends IEloquentService
{
    /**
     * @param array $boards
     *
     * @return ServiceResponse
     */
    public function updateOrder(
        array $boards
    ): ServiceResponse;
}
