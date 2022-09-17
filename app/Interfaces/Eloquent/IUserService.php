<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IUserService extends IEloquentService
{
    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param int|null $typeId
     *
     * @return ServiceResponse
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null,
        ?int    $typeId = null
    ): ServiceResponse;

    /**
     * @param int $typeId
     *
     * @return ServiceResponse
     */
    public function getAllByTypeId(
        int $typeId
    ): ServiceResponse;

    /**
     * @param int|null $typeId
     * @param array|null $userIds
     * @param array|null $projectIds
     *
     * @return ServiceResponse
     */
    public function getAllWithTimesheets(
        ?int   $typeId = null,
        ?array $userIds = [],
        ?array $projectIds = []
    ): ServiceResponse;

    /**
     * @param string $email
     * @param int|null $exceptId
     *
     * @return ServiceResponse
     */
    public function getByEmail(
        string $email,
        ?int   $exceptId = null
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getProfile(
        int $id
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $userId,
        int $theme
    ): ServiceResponse;

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getCompanies(
        int $userId
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function setCompanies(
        int   $userId,
        array $companyIds
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function setSingleCompany(
        int $userId,
        int $companyId
    ): ServiceResponse;

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getSelectedCompanies(
        int $userId
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function setSelectedCompanies(
        int   $userId,
        array $companyIds
    ): ServiceResponse;

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getUserMeetings(
        int $userId
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param array $meetingIds
     *
     * @return ServiceResponse
     */
    public function setUserMeetings(
        int   $userId,
        array $meetingIds
    ): ServiceResponse;

    /**
     * @param int $roleId
     * @param int $typeId
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     *
     * @return ServiceResponse
     */
    public function create(
        int     $roleId,
        int     $typeId,
        string  $name,
        string  $email,
        ?string $phone = null,
        ?string $identity = null
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $roleId
     * @param int $typeId
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
        int     $typeId,
        string  $name,
        string  $email,
        ?string $phone = null,
        ?string $identity = null
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param int $suspend
     *
     * @return ServiceResponse
     */
    public function setSuspend(
        int $userId,
        int $suspend
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function updatePassword(
        int    $userId,
        string $password
    ): ServiceResponse;

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getMeetings(
        int $userId,
    ): ServiceResponse;

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getCentralMissions(
        int $userId,
    ): ServiceResponse;
}
