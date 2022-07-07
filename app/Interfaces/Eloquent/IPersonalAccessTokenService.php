<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPersonalAccessTokenService
{
    /**
     * @param string $token
     *
     * @return ServiceResponse
     */
    public function findToken(
        string $token
    ): ServiceResponse;
}
