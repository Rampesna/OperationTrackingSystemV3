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
}
