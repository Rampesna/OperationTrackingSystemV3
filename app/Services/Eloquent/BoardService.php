<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IBoardService;
use App\Models\Eloquent\Board;
use App\Services\ServiceResponse;

class BoardService implements IBoardService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All boards',
            200,
            Board::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $board = Board::find($id);
        if ($board) {
            return new ServiceResponse(
                true,
                'Board',
                200,
                $board
            );
        } else {
            return new ServiceResponse(
                false,
                'Board not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $board = $this->getById($id);
        if ($board->isSuccess()) {
            return new ServiceResponse(
                true,
                'Board deleted',
                200,
                $board->getData()->delete()
            );
        } else {
            return $board;
        }
    }

    /**
     * @param array $boards {
     * @return ServiceResponse
     * @var int $order
     * }
     *
     * @var int $id
     */
    public function updateOrder(
        array $boards
    ): ServiceResponse
    {
        foreach ($boards as $board) {
            $getBoard = $this->getById($board['id']);
            if ($getBoard->isSuccess()) {
                $getBoard->getData()->order = $board['order'];
                $getBoard->getData()->save();
            }
        }

        return new ServiceResponse(
            true,
            'Board orders updated',
            200,
            null
        );
    }
}
