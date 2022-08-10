<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPurchaseService;
use App\Models\Eloquent\Purchase;
use App\Services\ServiceResponse;

class PurchaseService implements IPurchaseService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All purchases',
            200,
            Purchase::all()
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
        $purchase = Purchase::find($id);
        if ($purchase) {
            return new ServiceResponse(
                true,
                'Purchase',
                200,
                $purchase
            );
        } else {
            return new ServiceResponse(
                false,
                'Purchase not found',
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
        $purchase = $this->getById($id);
        if ($purchase->isSuccess()) {
            return new ServiceResponse(
                true,
                'Purchase deleted',
                200,
                $purchase->getData()->delete()
            );
        } else {
            return $purchase;
        }
    }

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
    ): ServiceResponse
    {
        $purchase = new Purchase();
        $purchase->user_id = $userId;
        $purchase->status_id = $statusId;
        $purchase->name = $name;
        $purchase->delivery_date = $deliveryDate;
        $purchase->receipt_number = $receiptNumber;
        $purchase->price = $price;
        $purchase->save();
        return new ServiceResponse(
            true,
            'Purchase created',
            201,
            $purchase
        );
    }

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
    ): ServiceResponse
    {
        $purchase = $this->getById($id);
        if ($purchase->isSuccess()) {
            $purchase->getData()->status_id = $statusId;
            $purchase->getData()->name = $name;
            $purchase->getData()->delivery_date = $deliveryDate;
            $purchase->getData()->receipt_number = $receiptNumber;
            $purchase->getData()->price = $price;
            $purchase->getData()->save();
            return new ServiceResponse(
                true,
                'Purchase updated',
                200,
                $purchase->getData()
            );
        } else {
            return $purchase;
        }
    }

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
    ): ServiceResponse
    {
        $purchases = Purchase::with([
            'user',
            'status',
            'purchaser'
        ])->where(function ($purchases) use ($userId) {
            $purchases->where('user_id', $userId)->orWhere('purchaser_id', $userId);
        });

        if ($keyword) {
            $purchases = $purchases->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('receipt_number', 'like', '%' . $keyword . '%');
            });
        }

        if ($statusId) {
            $purchases = $purchases->where('status_id', $statusId);
        }

        return new ServiceResponse(
            true,
            'Purchases',
            200,
            [
                'totalCount' => $purchases->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'purchases' => $purchases->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }
}
