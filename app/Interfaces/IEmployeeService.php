<?php

namespace App\Interfaces;

interface IEmployeeService extends IModelService
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
