<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IProjectVersionService extends IEloquentService
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
     * @param string $title
     * @param string $versionString
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function create(
        int     $projectId,
        string  $title,
        string  $versionString,
        ?string $description = null
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $title
     * @param string $versionString
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        string  $title,
        string  $versionString,
        ?string $description = null
    ): ServiceResponse;
}
