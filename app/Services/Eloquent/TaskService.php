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

    public function getById(
        int $id
    )
    {
        return Task::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function updateBoard(
        int $taskId,
        int $boardId
    )
    {
        $task = $this->getById($taskId);
        $task->board_id = $boardId;
        $task->save();

        return $task;
    }

    /**
     * @param array $tasks
     */
    public function updateOrder(
        array $tasks
    )
    {
        foreach ($tasks as $task) {
            $getTask = $this->getById(intval($task['id']));
            if ($getTask) {
                $getTask->order = intval($task['order']);
                $getTask->save();
            }
        }
    }

    /**
     * @param int $id
     * @param array $parameters
     */
    public function updateByParameters(
        int   $id,
        array $parameters
    )
    {
        $task = $this->getById($id);
        foreach ($parameters as $parameter) {
            $task->{$parameter['attribute']} = $parameter['value'];
        }
        $task->save();

        return $task;
    }

    /**
     * @param int $taskId
     */
    public function getFilesById(
        int $taskId
    )
    {
        return $this->getById($taskId)->files;
    }

    /**
     * @param int $taskId
     */
    public function getSubTasksById(
        int $taskId
    )
    {
        return $this->getById($taskId)->subTasks;
    }

    /**
     * @param int $taskId
     */
    public function getCommentsById(
        int $taskId
    )
    {
        return $this->getById($taskId)->comments;
    }
}
