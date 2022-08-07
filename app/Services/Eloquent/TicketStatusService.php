<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITicketStatusService;
use App\Models\Eloquent\TicketStatus;
use App\Services\ServiceResponse;

class TicketStatusService implements ITicketStatusService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All ticket statuses',
            200,
            TicketStatus::all()
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
        $ticketStatus = TicketStatus::find($id);
        if ($ticketStatus) {
            return new ServiceResponse(
                true,
                'Ticket status',
                200,
                $ticketStatus
            );
        } else {
            return new ServiceResponse(
                false,
                'Ticket status not found',
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
        $ticketStatus = $this->getById($id);
        if ($ticketStatus->isSuccess()) {
            return new ServiceResponse(
                true,
                'Ticket status deleted',
                200,
                $ticketStatus->getData()->delete()
            );
        } else {
            return $ticketStatus;
        }
    }
}
