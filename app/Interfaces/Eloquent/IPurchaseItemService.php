<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPurchaseItemService extends IEloquentService
{
    /**
     * @param int $purchaseId
     * @param array $items {
     * @type string $name
     * @type int $requestedQuantity
     * }
     *
     * @return ServiceResponse
     */
    public function setByPurchaseId(
        int   $purchaseId,
        array $items
    ): ServiceResponse;

    /**
     * @param array $purchasedItems {
     * @type int $id
     * @type float $purchasedQuantity
     * }
     *
     * @return ServiceResponse
     */
    public function setPurchasedQuantities(
        array $purchasedItems
    ): ServiceResponse;

    /**
     * @param int $purchaseId
     *
     * @return ServiceResponse
     */
    public function getByPurchaseId(
        int $purchaseId
    ): ServiceResponse;
}
