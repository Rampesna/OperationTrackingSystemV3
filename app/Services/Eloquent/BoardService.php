<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IBoardService;
use App\Models\Eloquent\Task;

class BoardService implements IBoardService
{
    public function getAll()
    {
        return Task::all();
    }

    public function getById(int $id)
    {
        return Task::find($id);
    }

    public function delete(int $id)
    {
        return $this->getById($id)->delete();
    }

    public function updateOrder(
        array $boardList
    )
    {
        foreach ($boardList as $key => $value) {
            if ($key && $value && gettype($key) == 'integer' && $key != 0) {
                $board = $this->getById($key);
                $board->order = $value;
                $board->save();
            };
        }
    }

}
