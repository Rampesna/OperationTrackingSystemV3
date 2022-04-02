<?php

namespace App\Interfaces\Eloquent;

interface IUserService extends IEloquentService
{
    /**
     * @param string $email
     */
    public function getByEmail(
        string $email
    );

    /**
     * @param string $email
     * @param string $password
     */
    public function login(
        string $email,
        string $password
    );

    /**
     * @param int $userId
     * @param int $theme
     */
    public function swapTheme(
        int $userId,
        int $theme
    );

    public function create(
        int    $roleId,
        string $name,
        string $email,
        string $phoneNumber = null,
        string $identificationNumber = null,
        int    $defaultCompanyId = null,
        string $password
    );

    public function update();
}
