<?php

namespace App\Interfaces\Eloquent;

interface IPersonalAccessTokenService
{
    /**
     * @param string $token
     */
    public function findToken(
        string $token
    );
}
