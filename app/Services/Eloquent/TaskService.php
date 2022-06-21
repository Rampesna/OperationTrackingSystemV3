<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITaskService;
use App\Models\Eloquent\Task;

class TaskService implements ITaskService
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

    public function updateBoard(int $taskId, int $boardId)
    {
        $task = $this->getById($taskId);
        $task->board_id = $boardId;
        $task->save();

        return $task;
    }

}
