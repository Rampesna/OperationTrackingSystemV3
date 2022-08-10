<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPurchaseItemService;
use App\Models\Eloquent\PurchaseItem;
use App\Services\ServiceResponse;

class PurchaseItemService implements IPurchaseItemService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All purchase items',
            200,
            PurchaseItem::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $purchaseItem = PurchaseItem::find($id);
        if ($purchaseItem) {
            return new ServiceResponse(
                true,
                'Purchase item',
                200,
                $purchaseItem
            );
        } else {
            return new ServiceResponse(
                false,
                'Purchase item not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $purchaseItem = $this->getById($id);
        if ($purchaseItem->isSuccess()) {
            return new ServiceResponse(
                true,
                'Purchase item deleted',
                200,
                $purchaseItem->getData()->delete()
            );
        } else {
            return $purchaseItem;
        }
    }

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
    ): ServiceResponse
    {
        PurchaseItem::where('purchase_id', $purchaseId)->delete();
        foreach ($items as $item) {
            $purchaseItem = new PurchaseItem;
            $purchaseItem->purchase_id = $purchaseId;
            $purchaseItem->name = $item['name'];
            $purchaseItem->requested_quantity = $item['requestedQuantity'];
            $purchaseItem->save();
        }

        return new ServiceResponse(
            true,
            'Purchase items created',
            200,
            PurchaseItem::where('purchase_id', $purchaseId)->get()
        );
    }

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
    ): ServiceResponse
    {
        foreach ($purchasedItems as $purchasedItem) {
            $purchaseItem = PurchaseItem::find($purchasedItem['id']);
            $purchaseItem->purchased_quantity = $purchasedItem['purchasedQuantity'];
            $purchaseItem->save();
        }

        return new ServiceResponse(
            true,
            'Purchase items updated',
            200,
            PurchaseItem::all()
        );
    }

    /**
     * @param int $purchaseId
     *
     * @return ServiceResponse
     */
    public function getByPurchaseId(
        int $purchaseId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Purchase items',
            200,
            PurchaseItem::where('purchase_id', $purchaseId)->get()
        );
    }
}
