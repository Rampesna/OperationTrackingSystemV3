<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IRecruitingStepSubStepService extends IEloquentService
{
    /**
     * @param int $recruitingStepId
     *
     * @return ServiceResponse
     */
    public function getAllByRecruitingStepId(
        int $recruitingStepId
    ): ServiceResponse;

    /**
     * @param int $recruitingStepId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $recruitingStepId,
        string $name
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse;
}
