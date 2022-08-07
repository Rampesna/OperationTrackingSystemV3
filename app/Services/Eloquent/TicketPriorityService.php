<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITicketPriorityService;
use App\Models\Eloquent\TicketPriority;
use App\Services\ServiceResponse;

class TicketPriorityService implements ITicketPriorityService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All ticket priorities',
            200,
            TicketPriority::all()
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
        $ticketPriority = TicketPriority::find($id);
        if ($ticketPriority) {
            return new ServiceResponse(
                true,
                'Ticket priority',
                200,
                $ticketPriority
            );
        } else {
            return new ServiceResponse(
                false,
                'Ticket priority not found',
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
        $ticketPriority = $this->getById($id);
        if ($ticketPriority->isSuccess()) {
            return new ServiceResponse(
                true,
                'Ticket priority deleted',
                200,
                $ticketPriority->getData()->delete()
            );
        } else {
            return $ticketPriority;
        }
    }
}
