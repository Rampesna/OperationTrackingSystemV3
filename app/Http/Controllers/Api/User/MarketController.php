<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\MarketController\IndexRequest;
use App\Http\Requests\Api\User\MarketController\GetByIdRequest;
use App\Http\Requests\Api\User\MarketController\CreateRequest;
use App\Http\Requests\Api\User\MarketController\UpdateRequest;
use App\Http\Requests\Api\User\MarketController\DeleteRequest;
use App\Interfaces\Eloquent\IMarketService;
use App\Traits\Response;

class MarketController extends Controller
{
    use Response;

    /**
     * @var $marketService
     */
    private $marketService;

    /**
     * @param IMarketService $marketService
     */
    public function __construct(IMarketService $marketService)
    {
        $this->marketService = $marketService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        $indexResponse = $this->marketService->index(
            $request->pageIndex,
            $request->pageSize,
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
        $getByIdResponse = $this->marketService->getById(
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
        $createResponse = $this->marketService->create(
            $request->code,
            $request->name,
            $request->password
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
        $updateResponse = $this->marketService->update(
            $request->id,
            $request->code,
            $request->name
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
        $deleteResponse = $this->marketService->delete(
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
