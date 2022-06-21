<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\BoardController\UpdateOrderRequest;
use App\Interfaces\Eloquent\IBoardService;
use App\Traits\Response;

class BoardController extends Controller
{
    use Response;

    private $boardService;

    public function __construct(IBoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    public function updateOrder(UpdateOrderRequest $request)
    {
        return $this->success('Boards', $this->boardService->updateOrder(
            $request->boards
        ));
    }
}
