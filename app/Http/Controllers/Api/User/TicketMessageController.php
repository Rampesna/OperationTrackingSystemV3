<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ITicketMessageService;
use App\Http\Requests\Api\User\TicketMessageController\GetAllRequest;
use App\Http\Requests\Api\User\TicketMessageController\GetByIdRequest;
use App\Http\Requests\Api\User\TicketMessageController\GetByTicketIdRequest;
use App\Http\Requests\Api\User\TicketMessageController\CreateRequest;
use App\Http\Requests\Api\User\TicketMessageController\UpdateRequest;
use App\Http\Requests\Api\User\TicketMessageController\DeleteRequest;
use App\Traits\Response;

class TicketMessageController extends Controller
{
    use Response;

    /**
     * @var $ticketMessageService
     */
    private $ticketMessageService;

    /**
     * @param ITicketMessageService $ticketMessageService
     */
    public function __construct(ITicketMessageService $ticketMessageService)
    {
        $this->ticketMessageService = $ticketMessageService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->ticketMessageService->getAll();
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

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->ticketMessageService->getById(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByTicketIdRequest $request
     */
    public function getByTicketId(GetByTicketIdRequest $request)
    {
        $getByTicketIdResponse = $this->ticketMessageService->getByTicketId(
            $request->ticketId
        );
        if ($getByTicketIdResponse->isSuccess()) {
            return $this->success(
                $getByTicketIdResponse->getMessage(),
                $getByTicketIdResponse->getData(),
                $getByTicketIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByTicketIdResponse->getMessage(),
                $getByTicketIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->ticketMessageService->create(
            $request->ticketId,
            $request->creatorType,
            $request->creatorId,
            $request->message,
        );
        if ($createResponse->isSuccess()) {
            return $this->success(
                $createResponse->getMessage(),
                $createResponse->getData(),
                $createResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->ticketMessageService->update(
            $request->id,
            $request->message,
        );
        if ($updateResponse->isSuccess()) {
            return $this->success(
                $updateResponse->getMessage(),
                $updateResponse->getData(),
                $updateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->ticketMessageService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
