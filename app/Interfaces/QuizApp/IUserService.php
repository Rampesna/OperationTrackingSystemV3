<?php


namespace App\Interfaces\QuizApp;

use App\Services\ServiceResponse;

interface IUserService
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function create(
        string $name,
        string $email,
        string $password
    ): ServiceResponse;
}
