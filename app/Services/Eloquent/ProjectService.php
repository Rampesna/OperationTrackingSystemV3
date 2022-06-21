<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IProjectService;
use App\Models\Eloquent\Project;

class ProjectService implements IProjectService
{
    public function getAll()
    {
        return Project::with([

        ])->all();
    }

    public function getById(
        int $id
    )
    {
        return Project::with([
            'status'
        ])->findOrFail($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function getByCompanyIds(
        array $companyIds
    )
    {
        return Project::with([

        ])->whereIn('company_id', $companyIds)->get();
    }

    public function getByProjectIds(
        array $projectIds
    )
    {
        return Project::with([
            'status'
        ])->whereIn('id', $projectIds)->get();
    }

    /**
     * @param int $projectId
     */
    public function getSubtasksByProjectId(
        int $projectId
    )
    {
        return $this->getById($projectId)->subtasks()->get()->toArray();
    }

    /**
     * @param int $projectId
     * @param int $management
     */
    public function getBoardsByProjectId(
        int $projectId,
        int $management
    )
    {
        return $this->getById($projectId)->boards()->with([
            'tasks' => function ($tasks) {
                $tasks->with([
                    'subTasks',
                    'priority'
                ]);
            }
        ])->where('management', $management)->get()->toArray();
    }

    /**
     * @param array $projectIds
     */
    public function getSubtasksByProjectIds(
        array $projectIds
    )
    {
        $subtasks = [];

        foreach ($projectIds as $projectId) {
            $subtasks = array_merge($subtasks, $this->getSubtasksByProjectId($projectId));
        }

        return $subtasks;
    }
}
