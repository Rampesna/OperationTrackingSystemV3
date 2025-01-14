<?php

namespace App\Interfaces\Eloquent;

use App\Interfaces\Eloquent\IEloquentService;
use App\Services\ServiceResponse;

/**
 *
 */
interface IFileQueesService extends IEloquentService
{

    /**
     * @param mixed $file
     * @param int $transactionTypeId
     * @param int $uploaderId
     * @param string $uploaderType
     * @param string|null $props
     * @return ServiceResponse
     */
    public function create(
        mixed   $file,
        int     $transactionTypeId,
        int     $uploaderId,
        string  $uploaderType,
        ?string $props
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $fileName
     * @param string $fileS3Path
     * @param int $transactionTypeId
     * @param int $statusId
     * @param int $uploaderId
     * @param string $uploaderType
     * @param string|null $props
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        string  $fileName,
        string  $fileS3Path,
        int     $transactionTypeId,
        int     $statusId,
        int     $uploaderId,
        string  $uploaderType,
        ?string $props
    ): ServiceResponse;

    /**
     * @param int $uploaderId
     * @param string $uploaderType
     * @param string|null $keyword
     * @param string|null $startDate
     * @param string|null $endDate
     * @param array|null $statusIds
     * @param array|null $transactionTypeIds
     * @return ServiceResponse
     */
    public function getByUploader(
        int     $uploaderId,
        string  $uploaderType,
        ?string $keyword,
        ?string $startDate,
        ?string $endDate,
        ?array  $statusIds,
        ?array  $transactionTypeIds
    ): ServiceResponse;

}
