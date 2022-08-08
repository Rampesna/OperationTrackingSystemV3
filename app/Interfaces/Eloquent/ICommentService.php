<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ICommentService extends IEloquentService
{
    /**
     * @param string $relationType
     * @param int $relationId
     *
     * @return ServiceResponse
     */
    public function getByRelation(
        string $relationType,
        int    $relationId,
    ): ServiceResponse;

    /**
     * @param string $creatorType
     * @param int $creatorId
     *
     * @return ServiceResponse
     */
    public function getByCreator(
        string $creatorType,
        int    $creatorId,
    ): ServiceResponse;

    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $creatorType
     * @param int $creatorId
     * @param string $commentString
     *
     * @return ServiceResponse
     */
    public function create(
        string $relationType,
        int    $relationId,
        string $creatorType,
        int    $creatorId,
        string $commentString,
    ): ServiceResponse;
}
