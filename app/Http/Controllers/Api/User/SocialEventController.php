<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\SocialEventController\GetAllRequest;
use App\Http\Requests\Api\User\SocialEventController\IndexRequest;
use App\Http\Requests\Api\User\SocialEventController\GetAllByDateOrderedRequest;
use App\Http\Requests\Api\User\SocialEventController\GetByIdRequest;
use App\Http\Requests\Api\User\SocialEventController\CreateRequest;
use App\Http\Requests\Api\User\SocialEventController\UpdateRequest;
use App\Http\Requests\Api\User\SocialEventController\DeleteRequest;
use App\Interfaces\Eloquent\ISocialEventService;
use App\Traits\Response;

class SocialEventController extends Controller
{
    use Response;

    /**
     * @var $socialEventService
     */
    private $socialEventService;

    /**
     * @param ISocialEventService $socialEventService
     */
    public function __construct(ISocialEventService $socialEventService)
    {
        $this->socialEventService = $socialEventService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->socialEventService->getAll();
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
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        $getAllResponse = $this->socialEventService->index(
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
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
     * @param GetAllByDateOrderedRequest $request
     */
    public function getAllByDateOrdered(GetAllByDateOrderedRequest $request)
    {
        $indexResponse = $this->socialEventService->getAllByDateOrdered();
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
        $getByIdResponse = $this->socialEventService->getById(
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
        $createResponse = $this->socialEventService->create(
            $request->name,
            $request->description,
            $request->date,
            $request->youtubeVideoUrl
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
        $updateResponse = $this->socialEventService->update(
            $request->id,
            $request->name,
            $request->description,
            $request->date,
            $request->youtubeVideoUrl
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
        $deleteResponse = $this->socialEventService->delete(
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
