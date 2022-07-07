<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IProjectService extends IEloquentService
{
    /**
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array $companyIds
    ): ServiceResponse;

    /**
     * @param array $projectIds
     *
     * @return ServiceResponse
     */
    public function getByProjectIds(
        array $projectIds
    ): ServiceResponse;

    /**
     * @param int $projectId
     *
     * @return ServiceResponse
     */
    public function getSubtasksByProjectId(
        int $projectId
    ): ServiceResponse;

    /**
     * @param int $projectId
     * @param int $management
     *
     * @return ServiceResponse
     */
    public function getBoardsByProjectId(
        int $projectId,
        int $management
    ): ServiceResponse;

    /**
     * @param array $projectIds
     *
     * @return ServiceResponse
     */
    public function getSubtasksByProjectIds(
        array $projectIds
    ): ServiceResponse;
}
