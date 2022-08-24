<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IMeetingAgendaService;
use App\Http\Requests\Api\User\MeetingAgendaController\IndexRequest;
use App\Http\Requests\Api\User\MeetingAgendaController\GetByIdRequest;
use App\Http\Requests\Api\User\MeetingAgendaController\CreateRequest;
use App\Http\Requests\Api\User\MeetingAgendaController\UpdateRequest;
use App\Http\Requests\Api\User\MeetingAgendaController\DeleteRequest;
use App\Traits\Response;

class MeetingAgendaController extends Controller
{
    use Response;

    /**
     * @var $meetingAgendaService
     */
    private $meetingAgendaService;

    /**
     * @param IMeetingAgendaService $meetingAgendaService
     */
    public function __construct(IMeetingAgendaService $meetingAgendaService)
    {
        $this->meetingAgendaService = $meetingAgendaService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        $indexResponse = $this->meetingAgendaService->index(
            $request->pageIndex,
            $request->pageSize,
            $request->meetingId,
            $request->keyword
        );
        if ($indexResponse->isSuccess()) {
            return $this->success(
                $indexResponse->getMessage(),
                $indexResponse->getData(),
                $indexResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $indexResponse->getMessage(),
                $indexResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->meetingAgendaService->getById(
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
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->meetingAgendaService->create(
            $request->user()->id,
            $request->meetingId,
            $request->subject
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
        $updateResponse = $this->meetingAgendaService->update(
            $request->id,
            $request->meetingId,
            $request->subject,
            $request->discussions,
            $request->result
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
        $deleteResponse = $this->meetingAgendaService->delete(
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
