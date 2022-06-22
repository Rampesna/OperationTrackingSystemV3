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

    /**
     * @param array $taskList
     */
    public function updateOrder(
        array $taskList
    );

    /**
     * @param int $id
     * @param array $parameters
     */
    public function updateByParameters(
        int   $id,
        array $parameters
    );

    /**
     * @param int $taskId
     */
    public function getFilesById(
        int $taskId
    );

    /**
     * @param int $taskId
     */
    public function getSubTasksById(
        int $taskId
    );

    /**
     * @param int $taskId
     */
    public function getCommentsById(
        int $taskId
    );
}
