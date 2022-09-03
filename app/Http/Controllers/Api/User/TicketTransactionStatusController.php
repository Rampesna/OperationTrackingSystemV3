<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\TicketTransactionStatusController\GetAllRequest;
use App\Interfaces\Eloquent\ITicketTransactionStatusService;
use App\Traits\Response;

class TicketTransactionStatusController extends Controller
{
    use Response;

    /**
     * @var $permitTypeService
     */
    private $permitTypeService;

    /**
     * @param ITicketTransactionStatusService $permitTypeService
     */
    public function __construct(ITicketTransactionStatusService $permitTypeService)
    {
        $this->permitTypeService = $permitTypeService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->permitTypeService->getAll();
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
