<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IProjectLandingCustomerService extends IEloquentService
{
    /**
     * @param int $projectId
     *
     * @return ServiceResponse
     */
    public function getAllByProjectId(
        int $projectId
    ): ServiceResponse;

    /**
     * @param int $projectId
     * @param array|null $customerIds
     *
     * @return ServiceResponse
     */
    public function updateByProjectId(
        int    $projectId,
        ?array $customerIds = []
    ): ServiceResponse;
}
