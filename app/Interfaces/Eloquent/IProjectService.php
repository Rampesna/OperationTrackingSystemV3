<?php

namespace App\Interfaces\Eloquent;

interface IProjectService extends IEloquentService
{
    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    );

    /**
     * @param array $projectIds
     */
    public function getByProjectIds(
        array $projectIds
    );

    /**
     * @param int $projectId
     */
    public function getSubtasksByProjectId(
        int $projectId
    );

    /**
     * @param int $projectId
     * @param int $management
     */
    public function getBoardsByProjectId(
        int $projectId,
        int $management
    );

    /**
     * @param array $projectIds
     */
    public function getSubtasksByProjectIds(
        array $projectIds
    );
}
