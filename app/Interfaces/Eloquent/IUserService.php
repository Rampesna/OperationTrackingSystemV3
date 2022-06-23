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
     * @param int $userId
     * @param int $companyId
     */
    public function swapCompany(
        int $userId,
        int $companyId
    );

    /**
     * @param int $userId
     * @param int $theme
     */
    public function swapTheme(
        int $userId,
        int $theme
    );

    /**
     * @param int $userId
     */
    public function getCompanies(
        int $userId
    );

    /**
     * @param int $userId
     * @param array $companyIds
     */
    public function setCompanies(
        int   $userId,
        array $companyIds
    );

    /**
     * @param int $userId
     * @param int $companyId
     */
    public function setSingleCompany(
        int $userId,
        int $companyId
    );

    /**
     * @param int $userId
     */
    public function getSelectedCompanies(
        int $userId
    );

    /**
     * @param int $userId
     * @param array $companyIds
     */
    public function setSelectedCompanies(
        int   $userId,
        array $companyIds
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
