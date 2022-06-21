<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IBoardService;
use App\Models\Eloquent\Board;

class BoardService implements IBoardService
{
    public function getAll()
    {
        return Board::all();
    }

    public function getById(int $id)
    {
        return Board::find($id);
    }

    public function delete(int $id)
    {
        return $this->getById($id)->delete();
    }

    public function updateOrder(
        array $boards
    )
    {
        foreach ($boards as $board) {
            $getBoard = $this->getById($board['id']);
            if ($getBoard) {
                $getBoard->order = $board['order'];
                $getBoard->save();
            }
        }
    }

}
