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
            'All projects',
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
            return $project;
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
     * @param array|null $statusIds
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByProjectIds(
        array   $projectIds,
        ?array  $statusIds = [],
        ?string $keyword = null,
        ?array  $ticketStatusIds = [],
    ): ServiceResponse
    {
        $projects = Project::with([
            'status',
            'tickets' => function ($tickets) use ($ticketStatusIds) {
                $tickets->when($ticketStatusIds, function ($tickets) use ($ticketStatusIds) {
                    $tickets->whereIn('status_id', $ticketStatusIds);
                });;
            }
        ])->whereIn('id', $projectIds);

        if ($statusIds && count($statusIds) > 0) {
            $projects->whereIn('status_id', $statusIds);
        }

        if ($keyword) {
            $projects = $projects->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Projects',
            200,
            $projects->get()
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
            return $project;
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
            return $project;
        }
    }

    /**
     * @param int $projectId
     * @param int $management
     *
     * @return ServiceResponse
     */
    public function getAllTasks(
        int $projectId,
        int $management
    ): ServiceResponse
    {
        $project = $this->getById($projectId);
        if ($project->isSuccess()) {
            return new ServiceResponse(
                true,
                'Project tasks',
                200,
                $project->getData()->tasks()->with([
                    'priority'
                ])->where('management', $management)->get()->toArray()
            );
        } else {
            return $project;
        }
    }

    /**
     * @param int $projectId
     *
     * @return ServiceResponse
     */
    public function getUsersByProjectId(
        int $projectId
    ): ServiceResponse
    {
        $project = $this->getById($projectId);
        if ($project->isSuccess()) {
            return new ServiceResponse(
                true,
                'Users',
                200,
                $project->getData()->users
            );
        } else {
            return $project;
        }
    }

    /**
     * @param int $projectId
     * @param array $userIds
     *
     * @return ServiceResponse
     */
    public function setUsersByProjectId(
        int   $projectId,
        array $userIds
    ): ServiceResponse
    {
        $project = $this->getById($projectId);
        if ($project->isSuccess()) {
            $project->getData()->users()->sync($userIds);
            return new ServiceResponse(
                true,
                'Users',
                200,
                $project->getData()->users
            );
        } else {
            return $project;
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

    /**
     * @param int $companyId
     * @param string $name
     * @param string|null $code
     * @param string|null $startDate
     * @param string|null $endDate
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function create(
        int     $companyId,
        string  $name,
        ?string $code = null,
        ?string $startDate = null,
        ?string $endDate = null,
        ?string $description = null
    ): ServiceResponse
    {
        $project = new Project;
        $project->company_id = $companyId;
        $project->status_id = 1;
        $project->name = $name;
        $project->code = $code;
        $project->start_date = $startDate;
        $project->end_date = $endDate;
        $project->description = $description;
        $project->save();
        return new ServiceResponse(
            true,
            'Project created',
            201,
            $project
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param int $statusId
     * @param string $name
     * @param string|null $code
     * @param string|null $startDate
     * @param string|null $endDate
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $companyId,
        int     $statusId,
        string  $name,
        ?string $code = null,
        ?string $startDate = null,
        ?string $endDate = null,
        ?string $description = null
    ): ServiceResponse
    {
        $project = $this->getById($id);
        if ($project->isSuccess()) {
            $project->getData()->company_id = $companyId;
            $project->getData()->status_id = $statusId;
            $project->getData()->name = $name;
            $project->getData()->code = $code;
            $project->getData()->start_date = $startDate;
            $project->getData()->end_date = $endDate;
            $project->getData()->description = $description;
            $project->getData()->save();
            return new ServiceResponse(
                true,
                'Project updated',
                200,
                $project->getData()
            );
        } else {
            return $project;
        }
    }
}
