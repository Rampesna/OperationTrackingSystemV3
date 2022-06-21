<?php

namespace App\Interfaces\Eloquent;

interface ITaskService extends IEloquentService
{
    /**
     * @param int $taskId
     * @param int $boardId
     */
    public function updateBoard(
        int $taskId,
        int $boardId
    );
}
