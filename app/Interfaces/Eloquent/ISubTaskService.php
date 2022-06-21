<?php

namespace App\Interfaces\Eloquent;

interface ISubTaskService extends IEloquentService
{
    /**
     * @param int $projectId
     */
    public function getByProjectId(
        int $projectId
    );

    /**
     * @param array $projectIds
     */
    public function getByProjectIds(
        array $projectIds
    );

    /**
     * @param int $taskId
     * @param string $name
     */
    public function create(
        int    $taskId,
        string $name
    );

    /**
     * @param int $id
     * @param string $name
     */
    public function update(
        int    $id,
        string $name
    );

    /**
     * @param int $id
     * @param int $checked
     */
    public function setChecked(
        int $id,
        int $checked
    );
}
