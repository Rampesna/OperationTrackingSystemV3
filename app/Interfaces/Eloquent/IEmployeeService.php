<?php

namespace App\Interfaces\Eloquent;

interface IEmployeeService extends IEloquentService
{
    /**
     * @param string $email
     */
    public function getByEmail(
        string $email
    );

    /**
     * @param string $keyword
     * @param int $pageIndex
     * @param int $pageSize
     * @param array $companyIds
     * @param int $leave
     */
    public function index(
        string $keyword,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        array  $companyIds = [],
        int    $leave = 0
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
