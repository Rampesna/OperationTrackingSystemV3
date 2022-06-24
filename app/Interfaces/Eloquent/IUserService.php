<?php

namespace App\Interfaces\Eloquent;

interface IUserService extends IEloquentService
{
    /**
     * @param string $email
     * @param int|null $exceptId
     */
    public function getByEmail(
        string $email,
        ?int   $exceptId = null
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

    /**
     * @param int $roleId
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     */
    public function create(
        int     $roleId,
        string  $name,
        string  $email,
        ?string $phone = null,
        ?string $identity = null
    );

    /**
     * @param int $id
     * @param int $roleId
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     */
    public function update(
        int     $id,
        int     $roleId,
        string  $name,
        string  $email,
        ?string $phone = null,
        ?string $identity = null
    );

    /**
     * @param int $userId
     * @param int $suspend
     */
    public function setSuspend(
        int $userId,
        int $suspend
    );

    /**
     * @param int $userId
     * @param string $password
     */
    public function updatePassword(
        int    $userId,
        string $password
    );
}
