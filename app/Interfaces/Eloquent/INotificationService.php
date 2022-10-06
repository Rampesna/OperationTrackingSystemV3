<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface INotificationService extends IEloquentService
{
    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $message
     *
     * @return ServiceResponse
     */
    public function create(
        string $relationType,
        int    $relationId,
        string $message
    ): ServiceResponse;
}
