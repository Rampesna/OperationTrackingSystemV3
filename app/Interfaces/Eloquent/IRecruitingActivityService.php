<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IRecruitingActivityService extends IEloquentService
{
    /**
     * @param int $recruitingId
     *
     * @return ServiceResponse
     */
    public function getByRecruitingId(
        int $recruitingId
    ): ServiceResponse;

    /**
     * @param int $recruitingId
     * @param string $transaction
     * @param int $userId
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function create(
        int    $recruitingId,
        string $transaction,
        int    $userId,
        string $description = null
    ): ServiceResponse;
}
