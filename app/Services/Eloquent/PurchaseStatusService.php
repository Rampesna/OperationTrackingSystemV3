<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPurchaseStatusService;
use App\Models\Eloquent\PurchaseStatus;
use App\Services\ServiceResponse;

class PurchaseStatusService implements IPurchaseStatusService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All purchase statuses',
            200,
            PurchaseStatus::all()
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
        $purchaseStatus = PurchaseStatus::find($id);
        if ($purchaseStatus) {
            return new ServiceResponse(
                true,
                'Purchase status',
                200,
                $purchaseStatus
            );
        } else {
            return new ServiceResponse(
                false,
                'Purchase status not found',
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
        $purchaseStatus = $this->getById($id);
        if ($purchaseStatus->isSuccess()) {
            return new ServiceResponse(
                true,
                'Purchase status deleted',
                200,
                $purchaseStatus->getData()->delete()
            );
        } else {
            return $purchaseStatus;
        }
    }
}
