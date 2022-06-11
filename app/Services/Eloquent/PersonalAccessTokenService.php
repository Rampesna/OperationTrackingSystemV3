<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPersonalAccessTokenService;
use Laravel\Sanctum\PersonalAccessToken;

class PersonalAccessTokenService implements IPersonalAccessTokenService
{
    /**
     * @param string $token
     */
    public function findToken(
        string $token
    )
    {
        return PersonalAccessToken::findToken($token);
    }
}
