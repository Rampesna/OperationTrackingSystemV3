<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IMeetingAgendaService extends IEloquentService
{
    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param int|null $meetingId
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?int    $meetingId = null,
        ?string $keyword = null
    ): ServiceResponse;

    /**
     * @param int $creatorId
     * @param int|null $meetingId
     * @param string $subject
     *
     * @return ServiceResponse
     */
    public function create(
        int    $creatorId,
        ?int   $meetingId,
        string $subject
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int|null $meetingId
     * @param string $subject
     * @param string|null $discussions
     * @param string|null $result
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        ?int    $meetingId,
        string  $subject,
        ?string $discussions = null,
        ?string $result = null
    ): ServiceResponse;
}
