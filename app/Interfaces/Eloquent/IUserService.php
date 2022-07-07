<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IUserService extends IEloquentService
{
    /**
     * @param string $email
     * @param int|null $exceptId
     *
     * @return ServiceResponse
     */
    public function getByEmail(
        string $email,
        ?int   $exceptId = null
    );

    /**
     * @param int $userId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $userId,
        int $theme
    );

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getCompanies(
        int $userId
    );

    /**
     * @param int $userId
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function setCompanies(
        int   $userId,
        array $companyIds
    );

    /**
     * @param int $userId
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function setSingleCompany(
        int $userId,
        int $companyId
    );

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getSelectedCompanies(
        int $userId
    );

    /**
     * @param int $userId
     * @param array $companyIds
     *
     * @return ServiceResponse
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
     *
     * @return ServiceResponse
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
     *
     * @return ServiceResponse
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
     *
     * @return ServiceResponse
     */
    public function setSuspend(
        int $userId,
        int $suspend
    );

    /**
     * @param int $userId
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function updatePassword(
        int    $userId,
        string $password
    );
}
