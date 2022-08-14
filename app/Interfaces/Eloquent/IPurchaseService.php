<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPurchaseService extends IEloquentService
{
    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param int|null $statusId
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getAllPaginate(
        int     $pageIndex,
        int     $pageSize,
        ?int    $statusId,
        ?string $keyword = null
    ): ServiceResponse;

    /**
     * @param int $userId
     * @param int $statusId
     * @param string $name
     * @param string $deliveryDate
     * @param string|null $receiptNumber
     * @param float|null $price
     *
     * @return ServiceResponse
     */
    public function create(
        int     $userId,
        int     $statusId,
        string  $name,
        string  $deliveryDate,
        ?string $receiptNumber,
        ?float  $price
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $statusId
     * @param string $name
     * @param string $deliveryDate
     * @param string|null $receiptNumber
     * @param float|null $price
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $statusId,
        string  $name,
        string  $deliveryDate,
        ?string $receiptNumber,
        ?float  $price
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $purchaserId
     *
     * @return ServiceResponse
     */
    public function updatePurchaser(
        int $id,
        int $purchaserId
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $receiptNumber
     * @param float $price
     *
     * @return ServiceResponse
     */
    public function sendForAccept(
        int    $id,
        string $receiptNumber,
        float  $price
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function accept(
        int $id
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
