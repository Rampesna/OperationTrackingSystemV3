<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITicketTransactionStatusService;
use App\Models\Eloquent\TicketTransactionStatus;
use App\Services\ServiceResponse;

class TicketTransactionStatusService implements ITicketTransactionStatusService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All ticket transaction statuses',
            200,
            TicketTransactionStatus::all()
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
        $ticketTransactionStatus = TicketTransactionStatus::find($id);
        if ($ticketTransactionStatus) {
            return new ServiceResponse(
                true,
                'Ticket transaction status',
                200,
                $ticketTransactionStatus
            );
        } else {
            return new ServiceResponse(
                false,
                'Ticket transaction status not found',
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
        $ticketTransactionStatus = $this->getById($id);
        if ($ticketTransactionStatus->isSuccess()) {
            return new ServiceResponse(
                true,
                'Ticket transaction status deleted',
                200,
                $ticketTransactionStatus->getData()->delete()
            );
        } else {
            return $ticketTransactionStatus;
        }
    }
}
