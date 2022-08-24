<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IMeetingService;
use App\Http\Requests\Api\User\MeetingController\GetDateBetweenByUserIdRequest;
use App\Http\Requests\Api\User\MeetingController\GetAllByUserIdRequest;
use App\Http\Requests\Api\User\MeetingController\GetByIdRequest;
use App\Http\Requests\Api\User\MeetingController\CreateRequest;
use App\Http\Requests\Api\User\MeetingController\UpdateRequest;
use App\Http\Requests\Api\User\MeetingController\DeleteRequest;
use App\Traits\Response;

class MeetingController extends Controller
{
    use Response;

    /**
     * @var $meetingService
     */
    private $meetingService;

    /**
     * @param IMeetingService $meetingService
     */
    public function __construct(IMeetingService $meetingService)
    {
        $this->meetingService = $meetingService;
    }

    /**
     * @param GetDateBetweenByUserIdRequest $request
     */
    public function getDateBetweenByUserId(GetDateBetweenByUserIdRequest $request)
    {
        $getDateBetweenByUserIdResponse = $this->meetingService->getDateBetweenByUserId(
            $request->user()->id,
            $request->startDate,
            $request->endDate,
            $request->keyword
        );
        if ($getDateBetweenByUserIdResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenByUserIdResponse->getMessage(),
                $getDateBetweenByUserIdResponse->getData(),
                $getDateBetweenByUserIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenByUserIdResponse->getMessage(),
                $getDateBetweenByUserIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetAllByUserIdRequest $request
     */
    public function getAllByUserId(GetAllByUserIdRequest $request)
    {
        $getAllByUserIdResponse = $this->meetingService->getAllByUserId(
            $request->user()->id
        );
        if ($getAllByUserIdResponse->isSuccess()) {
            return $this->success(
                $getAllByUserIdResponse->getMessage(),
                $getAllByUserIdResponse->getData(),
                $getAllByUserIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllByUserIdResponse->getMessage(),
                $getAllByUserIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->meetingService->getById(
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
        $createResponse = $this->meetingService->create(
            $request->user()->id,
            $request->name,
            $request->description,
            $request->startDate,
            $request->endDate,
            $request->location,
            $request->typeId
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
        $updateResponse = $this->meetingService->update(
            $request->id,
            $request->user()->id,
            $request->name,
            $request->description,
            $request->startDate,
            $request->endDate,
            $request->location,
            $request->typeId
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
        $meetingResponse = $this->meetingService->getById(
            $request->id
        );
        if ($meetingResponse->isSuccess()) {
            if ($meetingResponse->getData()->creator_id != $request->user()->id) {
                return $this->error(
                    'You are not authorized to delete this meeting',
                    403
                );
            } else {
                $deleteResponse = $this->meetingService->delete(
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
        } else {
            return $this->error(
                $meetingResponse->getMessage(),
                $meetingResponse->getStatusCode()
            );
        }
    }
}
