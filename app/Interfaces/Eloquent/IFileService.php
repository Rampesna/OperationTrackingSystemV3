<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IFileService extends IEloquentService
{
    /**
     * @param int $uploaderId
     * @param string $uploaderType
     * @param int $relationId
     * @param string $relationType
     * @param string|null $type
     * @param string|null $icon
     * @param string $name
     * @param string $path
     *
     * @return ServiceResponse
     */
    public function create(
        int     $uploaderId,
        string  $uploaderType,
        int     $relationId,
        string  $relationType,
        ?string $type,
        ?string $icon,
        string  $name,
        string  $path
    ): ServiceResponse;

    /**
     * @param int $relationId
     * @param string $relationType
     *
     * @return ServiceResponse
     */
    public function getByRelation(
        int    $relationId,
        string $relationType
    ): ServiceResponse;
}
