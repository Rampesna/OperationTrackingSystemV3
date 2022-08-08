<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\BoardController\CreateRequest;
use App\Http\Requests\Api\User\BoardController\UpdateNameRequest;
use App\Http\Requests\Api\User\BoardController\UpdateOrderRequest;
use App\Http\Requests\Api\User\BoardController\DeleteRequest;
use App\Interfaces\Eloquent\IBoardService;
use App\Traits\Response;

class BoardController extends Controller
{
    use Response;

    /**
     * @var $boardService
     */
    private $boardService;

    /**
     * @param IBoardService $boardService
     */
    public function __construct(IBoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->boardService->create(
            $request->projectId,
            $request->name,
            $request->management
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
     * @param UpdateNameRequest $request
     */
    public function updateName(UpdateNameRequest $request)
    {
        $updateNameResponse = $this->boardService->updateName(
            $request->id,
            $request->name
        );
        if ($updateNameResponse->isSuccess()) {
            return $this->success(
                $updateNameResponse->getMessage(),
                $updateNameResponse->getData(),
                $updateNameResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateNameResponse->getMessage(),
                $updateNameResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateOrderRequest $request
     */
    public function updateOrder(UpdateOrderRequest $request)
    {
        $updateOrderResponse = $this->boardService->updateOrder(
            $request->boards
        );
        if ($updateOrderResponse->isSuccess()) {
            return $this->success(
                $updateOrderResponse->getMessage(),
                $updateOrderResponse->getData(),
                $updateOrderResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateOrderResponse->getMessage(),
                $updateOrderResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->boardService->delete(
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
