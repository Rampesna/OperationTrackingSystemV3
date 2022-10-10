<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface INotificationService extends IEloquentService
{
    /**
     * @param string $relationType
     * @param int $relationId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function index(
        string  $relationType,
        int     $relationId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword
    ): ServiceResponse;

    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $heading
     * @param string $message
     *
     * @return ServiceResponse
     */
    public function create(
        string $relationType,
        int    $relationId,
        string $heading,
        string $message
    ): ServiceResponse;
}
