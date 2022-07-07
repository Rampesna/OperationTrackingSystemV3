<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ITaskService extends IEloquentService
{
    /**
     * @param int $taskId
     * @param int $boardId
     *
     * @return ServiceResponse
     */
    public function updateBoard(
        int $taskId,
        int $boardId
    );

    /**
     * @param array $taskList
     *
     * @return ServiceResponse
     */
    public function updateOrder(
        array $taskList
    );

    /**
     * @param int $id
     * @param array $parameters
     *
     * @return ServiceResponse
     */
    public function updateByParameters(
        int   $id,
        array $parameters
    );

    /**
     * @param int $taskId
     *
     * @return ServiceResponse
     */
    public function getFilesById(
        int $taskId
    );

    /**
     * @param int $taskId
     *
     * @return ServiceResponse
     */
    public function getSubTasksById(
        int $taskId
    );

    /**
     * @param int $taskId
     *
     * @return ServiceResponse
     */
    public function getCommentsById(
        int $taskId
    );
}
