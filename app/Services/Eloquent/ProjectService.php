<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IProjectService;
use App\Models\Eloquent\Project;
use App\Services\ServiceResponse;

class ProjectService implements IProjectService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            '',
            200,
            Project::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $project = Project::with([
            'status'
        ])->find($id);
        if ($project) {
            return new ServiceResponse(
                true,
                'Project',
                200,
                $project
            );
        } else {
            return new ServiceResponse(
                false,
                'Project not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $project = $this->getById($id);
        if ($project->isSuccess()) {
            return new ServiceResponse(
                true,
                'Project deleted',
                200,
                $project->getData()->delete()
            );
        } else {
            return new ServiceResponse(
                false,
                'Project not found',
                404,
                null
            );
        }
    }

    /**
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array $companyIds
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Projects',
            200,
            Project::whereIn('company_id', $companyIds)->get()
        );
    }

    /**
     * @param array $projectIds
     *
     * @return ServiceResponse
     */
    public function getByProjectIds(
        array $projectIds
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Projects',
            200,
            Project::whereIn('id', $projectIds)->get()
        );
    }

    /**
     * @param int $projectId
     *
     * @return ServiceResponse
     */
    public function getSubtasksByProjectId(
        int $projectId
    ): ServiceResponse
    {
        $project = $this->getById($projectId);
        if ($project->isSuccess()) {
            return new ServiceResponse(
                true,
                'Subtasks',
                200,
                $project->getData()->subtasks()->get()->toArray()
            );
        } else {
            return new ServiceResponse(
                false,
                'Project not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $projectId
     * @param int $management
     *
     * @return ServiceResponse
     */
    public function getBoardsByProjectId(
        int $projectId,
        int $management
    ): ServiceResponse
    {
        $project = $this->getById($projectId);
        if ($project->isSuccess()) {
            return new ServiceResponse(
                true,
                'Subtasks',
                200,
                $project->getData()->boards()->with([
                    'tasks' => function ($tasks) {
                        $tasks->with([
                            'subTasks',
                            'priority'
                        ]);
                    }
                ])->where('management', $management)->get()->toArray()
            );
        } else {
            return new ServiceResponse(
                false,
                'Project not found',
                404,
                null
            );
        }
    }

    /**
     * @param array $projectIds
     *
     * @return ServiceResponse
     */
    public function getSubtasksByProjectIds(
        array $projectIds
    ): ServiceResponse
    {
        $subtasks = [];

        foreach ($projectIds as $projectId) {
            $projectSubtasks = $this->getSubtasksByProjectId($projectId);
            if ($projectSubtasks->isSuccess()) {
                $subtasks = array_merge($subtasks, $projectSubtasks->getData());
            }
        }

        return new ServiceResponse(
            true,
            'Subtasks',
            200,
            $subtasks
        );
    }
}
