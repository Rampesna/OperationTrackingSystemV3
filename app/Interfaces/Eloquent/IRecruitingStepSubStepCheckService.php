<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IRecruitingStepSubStepCheckService extends IEloquentService
{
    /**
     * @param int $recruitingId
     * @param int $recruitingStepId
     * @param int $recruitingStepSubStepId
     * @param int $userId
     */
    public function create(
        int $recruitingId,
        int $recruitingStepId,
        int $recruitingStepSubStepId,
        int $userId
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function updateCheck(
        int $id
    ): ServiceResponse;
}
