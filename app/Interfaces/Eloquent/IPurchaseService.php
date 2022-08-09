<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPurchaseService extends IEloquentService
{
    /**
     * @param int $userId
     * @param int $statusId
     * @param string $name
     * @param string $deliveryDate
     * @param string $receiptNumber
     * @param float $price
     *
     * @return ServiceResponse
     */
    public function create(
        int    $userId,
        int    $statusId,
        string $name,
        string $deliveryDate,
        string $receiptNumber,
        float  $price
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $statusId
     * @param string $name
     * @param string $deliveryDate
     * @param string $receiptNumber
     * @param float $price
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $statusId,
        string $name,
        string $deliveryDate,
        string $receiptNumber,
        float  $price
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param int|null $statusId
     *
     * @return ServiceResponse
     */
    public function getByUserId(
        int     $userId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword,
        ?int    $statusId
    ): ServiceResponse;
}
