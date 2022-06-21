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

}
