<?php

namespace App\Interfaces\NetsantralApi;

use App\Services\ServiceResponse;

interface INetsantralApiService
{
    /**
     * @return ServiceResponse
     */
    public function callQueues(): ServiceResponse;

    /**
     * @param string $queueShort
     *
     * @return ServiceResponse
     */
    public function abandons(
        string $queueShort
    ): ServiceResponse;
}
