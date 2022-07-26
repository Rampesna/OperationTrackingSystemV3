<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\BoardController\UpdateOrderRequest;
use App\Interfaces\Eloquent\IBoardService;
use App\Models\Eloquent\Board;
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
}
