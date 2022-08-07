<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ITicketService extends IEloquentService
{
    /**
     * @param string $relationType
     * @param int $relationId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param array|null $priorityIds
     * @param array|null $statusIds
     *
     * @return ServiceResponse
     */
    public function getByRelation(
        string  $relationType,
        int     $relationId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword,
        ?array  $priorityIds,
        ?array  $statusIds
    ): ServiceResponse;

    /**
     * @param string $creatorType
     * @param int $creatorId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param array|null $priorityIds
     * @param array|null $statusIds
     *
     * @return ServiceResponse
     */
    public function getByCreator(
        string  $creatorType,
        int     $creatorId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword,
        ?array  $priorityIds,
        ?array  $statusIds
    ): ServiceResponse;

    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $creatorType
     * @param int $creatorId
     * @param int $priorityId
     * @param int|null $subjectId
     * @param int $statusId
     * @param string $title
     * @param string|null $source
     * @param string|null $description
     * @param string|null $notes
     * @param string|null $requestedEndDate
     * @param string|null $todoEndDate
     *
     * @return ServiceResponse
     */
    public function create(
        string  $relationType,
        int     $relationId,
        string  $creatorType,
        int     $creatorId,
        int     $priorityId,
        ?int    $subjectId,
        int     $statusId,
        string  $title,
        ?string $source,
        ?string $description,
        ?string $notes,
        ?string  $requestedEndDate,
        ?string  $todoEndDate
    ): ServiceResponse;

    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $creatorType
     * @param int $creatorId
     * @param int $priorityId
     * @param int|null $subjectId
     * @param int $statusId
     * @param string $title
     * @param string|null $source
     * @param string|null $description
     * @param string|null $notes
     * @param string|null $requestedEndDate
     * @param string|null $todoEndDate
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        string  $relationType,
        int     $relationId,
        string  $creatorType,
        int     $creatorId,
        int     $priorityId,
        ?int    $subjectId,
        int     $statusId,
        string  $title,
        ?string $source,
        ?string $description,
        ?string $notes,
        ?string  $requestedEndDate,
        ?string  $todoEndDate
    ): ServiceResponse;
}
