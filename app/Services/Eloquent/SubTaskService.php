<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ISubTaskService;
use App\Models\Eloquent\SubTask;

class SubTaskService implements ISubTaskService
{
    public function getAll()
    {
        return SubTask::all();
    }

    public function getById(
        int $id
    )
    {
        return SubTask::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function getByProjectId(
        int $projectId
    )
    {
        return SubTask::where('project_id', $projectId)->get();
    }

    public function getByProjectIds(
        array $projectIds
    )
    {
        return SubTask::whereIn('project_id', $projectIds)->get();
    }

    /**
     * @param int $taskId
     * @param string $name
     */
    public function create(
        int    $taskId,
        string $name
    )
    {
        $subTask = new SubTask;
        $subTask->task_id = $taskId;
        $subTask->name = $name;
        $subTask->order = SubTask::where('task_id', $taskId)->count() + 1;
        $subTask->checked = 0;
        $subTask->save();

        return $subTask;
    }

    /**
     * @param int $id
     * @param string $name
     */
    public function update(
        int    $id,
        string $name
    )
    {
        $subTask = $this->getById($id);
        $subTask->name = $name;
        $subTask->save();

        return $subTask;
    }

    /**
     * @param int $id
     * @param int $checked
     */
    public function setChecked(
        int $id,
        int $checked
    )
    {
        $subTask = $this->getById($id);
        $subTask->checked = $checked;
        $subTask->save();

        return $subTask;
    }
}
