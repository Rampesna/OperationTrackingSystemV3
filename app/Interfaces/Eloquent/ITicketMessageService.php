<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ITicketMessageService extends IEloquentService
{
    /**
     * @param int $ticketId
     *
     * @return ServiceResponse
     */
    public function getByTicketId(
        int $ticketId
    ): ServiceResponse;

    /**
     * @param int $ticketId
     * @param string $creatorType
     * @param int $creatorId
     * @param string $message
     *
     * @return ServiceResponse
     */
    public function create(
        int    $ticketId,
        string $creatorType,
        int    $creatorId,
        string $message
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $message
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $message
    ): ServiceResponse;
}
