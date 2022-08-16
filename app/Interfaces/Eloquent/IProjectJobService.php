<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IProjectJobService extends IEloquentService
{
    /**
     * @param int $projectId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByProjectId(
        int     $projectId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
    ): ServiceResponse;

    /**
     * @param int $projectId
     * @param int|null $creatorId
     * @param int|null $landingCustomerId
     * @param int $typeId
     * @param string $code
     * @param string $subject
     * @param string|null $description
     * @param string|null $image
     * @param string|null $startDate
     * @param string|null $endDate
     *
     * @return ServiceResponse
     */
    public function create(
        int     $projectId,
        ?int    $creatorId,
        ?int    $landingCustomerId,
        int     $typeId,
        string  $code,
        string  $subject,
        ?string $description = null,
        ?string $image = null,
        ?string $startDate = null,
        ?string $endDate = null
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $projectId
     * @param int|null $creatorId
     * @param int|null $landingCustomerId
     * @param int $typeId
     * @param string $code
     * @param string $subject
     * @param string|null $description
     * @param string|null $image
     * @param string|null $startDate
     * @param string|null $endDate
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $projectId,
        ?int    $creatorId,
        ?int    $landingCustomerId,
        int     $typeId,
        string  $code,
        string  $subject,
        ?string $description = null,
        ?string $image = null,
        ?string $startDate = null,
        ?string $endDate = null
    ): ServiceResponse;
}
