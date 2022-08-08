<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ICentralMissionService extends IEloquentService
{
    /**
     * @param string $relationType
     * @param int $relationId
     * @param int $pageIndex
     * @param int $pageSize
     * @param array|null $typeIds
     * @param array|null $statusIds
     *
     * @return ServiceResponse
     */
    public function getByRelation(
        string $relationType,
        int    $relationId,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        ?array $typeIds = [],
        ?array $statusIds = []
    ): ServiceResponse;

    /**
     * @param int $typeId
     * @param int $statusId
     * @param int $relationId
     * @param string $relationType
     * @param string $title
     * @param string|null $description
     * @param string|null $startDate
     * @param string|null $endDate
     *
     * @return ServiceResponse
     */
    public function create(
        int     $typeId,
        int     $statusId,
        int     $relationId,
        string  $relationType,
        string  $title,
        ?string $description,
        ?string $startDate,
        ?string $endDate,
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $typeId
     * @param int $statusId
     * @param int $relationId
     * @param string $relationType
     * @param string $title
     * @param string|null $description
     * @param string|null $startDate
     * @param string|null $endDate
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $typeId,
        int     $statusId,
        int     $relationId,
        string  $relationType,
        string  $title,
        ?string $description,
        ?string $startDate,
        ?string $endDate,
    ): ServiceResponse;
}
