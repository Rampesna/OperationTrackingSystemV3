<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IRecruitingEvaluationParameterService extends IEloquentService
{
    /**
     * @param int $recruitingId
     */
    public function getAllByRecruitingId(
        int $recruitingId,
    ): ServiceResponse;

    /**
     * @param int $recruitingId
     * @param string $parameter
     */
    public function create(
        int    $recruitingId,
        string $parameter
    ): ServiceResponse;

    /**
     * @param int $id
     */
    public function check(
        int $id
    ): ServiceResponse;
}
