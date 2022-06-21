<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITaskPriorityService;
use App\Models\Eloquent\TaskPriority;

class TaskPriorityService implements ITaskPriorityService
{
    public function getAll()
    {
        return TaskPriority::all();
    }

    public function getById(
        int $id
    )
    {
        return TaskPriority::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

}
