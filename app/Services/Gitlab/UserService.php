<?php

namespace App\Services\Gitlab;

use App\Interfaces\Gitlab\IUserService;
use App\Services\ServiceResponse;

class UserService extends GitlabService implements IUserService
{
    /**
     * @return ServiceResponse
     */
    public function getAllUsers(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All gitlab users',
            200,
            $this->gitlabClient()->users()->all()
        );
    }
}
