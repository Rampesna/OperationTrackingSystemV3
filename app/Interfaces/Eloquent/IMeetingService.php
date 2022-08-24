<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IMeetingService extends IEloquentService
{
    /**
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getDateBetweenByUserId(
        int     $userId,
        string  $startDate,
        string  $endDate,
        ?string $keyword
    ): ServiceResponse;

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getAllByUserId(
        int $userId
    ): ServiceResponse;

    /**
     * @param int $meetingId
     *
     * @return ServiceResponse
     */
    public function getMeetingUsers(
        int $meetingId,
    ): ServiceResponse;

    /**
     * @param int $meetingId
     * @param array $userIds
     *
     * @return ServiceResponse
     */
    public function setMeetingUsers(
        int   $meetingId,
        array $userIds
    ): ServiceResponse;

    /**
     * @param int $creatorId
     * @param string $name
     * @param string|null $description
     * @param string $startDate
     * @param string $endDate
     * @param string $location
     * @param int $typeId
     *
     * @return ServiceResponse
     */
    public function create(
        int     $creatorId,
        string  $name,
        ?string $description,
        string  $startDate,
        string  $endDate,
        string  $location,
        int     $typeId
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $creatorId
     * @param string $name
     * @param string|null $description
     * @param string $startDate
     * @param string $endDate
     * @param string $location
     * @param int $typeId
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $creatorId,
        string  $name,
        ?string $description,
        string  $startDate,
        string  $endDate,
        string  $location,
        int     $typeId
    ): ServiceResponse;
}
