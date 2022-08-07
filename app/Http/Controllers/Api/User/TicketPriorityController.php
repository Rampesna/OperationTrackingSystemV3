<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\TicketPriorityController\GetAllRequest;
use App\Interfaces\Eloquent\ITicketPriorityService;
use App\Traits\Response;

class TicketPriorityController extends Controller
{
    use Response;

    /**
     * @var $ticketPriorityService
     */
    private $ticketPriorityService;

    /**
     * @param ITicketPriorityService $ticketPriorityService
     */
    public function __construct(ITicketPriorityService $ticketPriorityService)
    {
        $this->ticketPriorityService = $ticketPriorityService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->ticketPriorityService->getAll();
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
