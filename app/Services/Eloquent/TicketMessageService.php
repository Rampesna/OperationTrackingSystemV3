<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITicketMessageService;
use App\Models\Eloquent\TicketMessage;
use App\Services\ServiceResponse;

class TicketMessageService implements ITicketMessageService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All ticket messages',
            200,
            TicketMessage::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $ticketMessage = TicketMessage::with([
            'ticket',
            'creator',
            'files',
        ])->find($id);
        if ($ticketMessage) {
            return new ServiceResponse(
                true,
                'Ticket message',
                200,
                $ticketMessage
            );
        } else {
            return new ServiceResponse(
                false,
                'Ticket message not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $ticketMessage = $this->getById($id);
        if ($ticketMessage->isSuccess()) {
            return new ServiceResponse(
                true,
                'Ticket message deleted',
                200,
                $ticketMessage->getData()->delete()
            );
        } else {
            return $ticketMessage;
        }
    }

    /**
     * @param int $ticketId
     *
     * @return ServiceResponse
     */
    public function getByTicketId(
        int $ticketId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Ticket messages',
            200,
            TicketMessage::with([
                'ticket',
                'creator',
                'files',
            ])->where('ticket_id', $ticketId)->get()
        );
    }

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
    ): ServiceResponse
    {
        $ticketMessage = new TicketMessage();
        $ticketMessage->ticket_id = $ticketId;
        $ticketMessage->creator_type = $creatorType;
        $ticketMessage->creator_id = $creatorId;
        $ticketMessage->message = $message;
        $ticketMessage->save();
        return new ServiceResponse(
            true,
            'Ticket message created',
            201,
            $ticketMessage
        );
    }

    /**
     * @param int $id
     * @param string $message
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $message
    ): ServiceResponse
    {
        $ticketMessage = $this->getById($id);
        if ($ticketMessage->isSuccess()) {
            $ticketMessage->getData()->message = $message;
            $ticketMessage->getData()->save();
            return new ServiceResponse(
                true,
                'Ticket message updated',
                200,
                $ticketMessage->getData()
            );
        } else {
            return $ticketMessage;
        }
    }
}
