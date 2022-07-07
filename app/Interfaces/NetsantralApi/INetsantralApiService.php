<?php

namespace App\Interfaces\NetsantralApi;

use App\Services\ServiceResponse;

interface INetsantralApiService
{
    /**
     * @return ServiceResponse
     */
    public function callQueues();
}
