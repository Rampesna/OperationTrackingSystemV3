<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ISubTaskService extends IEloquentService
{
    /**
     * @param int $projectId
     *
     * @return ServiceResponse
     */
    public function getByProjectId(
        int $projectId
    );

    /**
     * @param array $projectIds
     *
     * @return ServiceResponse
     */
    public function getByProjectIds(
        array $projectIds
    );

    /**
     * @param int $taskId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $taskId,
        string $name
    );

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    );

    /**
     * @param int $id
     * @param int $checked
     *
     * @return ServiceResponse
     */
    public function setChecked(
        int $id,
        int $checked
    );
}
