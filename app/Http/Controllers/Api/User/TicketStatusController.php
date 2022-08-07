<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\TicketStatusController\GetAllRequest;
use App\Interfaces\Eloquent\ITicketStatusService;
use App\Traits\Response;

class TicketStatusController extends Controller
{
    use Response;

    /**
     * @var $ticketStatusService
     */
    private $ticketStatusService;

    /**
     * @param ITicketStatusService $ticketStatusService
     */
    public function __construct(ITicketStatusService $ticketStatusService)
    {
        $this->ticketStatusService = $ticketStatusService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->ticketStatusService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }
}
