<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ITicketService;
use App\Http\Requests\Api\User\TicketController\GetAllRequest;
use App\Http\Requests\Api\User\TicketController\GetByIdRequest;
use App\Http\Requests\Api\User\TicketController\GetByRelationRequest;
use App\Http\Requests\Api\User\TicketController\GetByCreatorRequest;
use App\Http\Requests\Api\User\TicketController\CreateRequest;
use App\Http\Requests\Api\User\TicketController\UpdateRequest;
use App\Http\Requests\Api\User\TicketController\DeleteRequest;
use App\Traits\Response;

class TicketController extends Controller
{
    use Response;

    /**
     * @var $ticketService
     */
    private $ticketService;

    /**
     * @param ITicketService $ticketService
     */
    public function __construct(ITicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->ticketService->getAll();
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
        $getByIdResponse = $this->ticketService->getById(
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
     * @param GetByRelationRequest $request
     */
    public function getByRelation(GetByRelationRequest $request)
    {
        $getByRelationResponse = $this->ticketService->getByRelation(
            $request->relationType,
            $request->relationId,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword,
            $request->priorityIds,
            $request->statusIds
        );
        if ($getByRelationResponse->isSuccess()) {
            return $this->success(
                $getByRelationResponse->getMessage(),
                $getByRelationResponse->getData(),
                $getByRelationResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByRelationResponse->getMessage(),
                $getByRelationResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByCreatorRequest $request
     */
    public function getByCreator(GetByCreatorRequest $request)
    {
        $getByCreatorResponse = $this->ticketService->getByCreator(
            $request->creatorType,
            $request->creatorId,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword,
            $request->priorityIds,
            $request->statusIds
        );
        if ($getByCreatorResponse->isSuccess()) {
            return $this->success(
                $getByCreatorResponse->getMessage(),
                $getByCreatorResponse->getData(),
                $getByCreatorResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCreatorResponse->getMessage(),
                $getByCreatorResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->ticketService->create(
            $request->relationType,
            $request->relationId,
            $request->creatorType,
            $request->creatorId,
            $request->priorityId,
            $request->subjectId,
            $request->statusId,
            $request->title,
            $request->source,
            $request->description,
            $request->notes,
            $request->requestedEndDate,
            $request->todoEndDate
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
        $updateResponse = $this->ticketService->update(
            $request->id,
            $request->relationType,
            $request->relationId,
            $request->creatorType,
            $request->creatorId,
            $request->priorityId,
            $request->subjectId,
            $request->statusId,
            $request->title,
            $request->source,
            $request->description,
            $request->notes,
            $request->requestedEndDate,
            $request->todoEndDate
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
        $deleteResponse = $this->ticketService->delete(
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
