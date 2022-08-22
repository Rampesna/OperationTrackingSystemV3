<?php

namespace App\Interfaces\Gitlab;

use App\Services\ServiceResponse;

interface IUserService
{
    /**
     * @return ServiceResponse
     */
    public function getAllUsers(): ServiceResponse;
}
