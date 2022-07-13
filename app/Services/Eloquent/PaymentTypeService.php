<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPaymentTypeService;
use App\Models\Eloquent\PaymentType;
use App\Services\ServiceResponse;

class PaymentTypeService implements IPaymentTypeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All payment types',
            200,
            PaymentType::all()
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
        $paymentType = PaymentType::find($id);
        if ($paymentType) {
            return new ServiceResponse(
                true,
                'Payment type',
                200,
                $paymentType
            );
        } else {
            return new ServiceResponse(
                false,
                'Payment type not found',
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
        $paymentType = $this->getById($id);
        if ($paymentType->isSuccess()) {
            return new ServiceResponse(
                true,
                'Payment type deleted',
                200,
                $paymentType->getData()->delete()
            );
        } else {
            return new ServiceResponse(
                false,
                'Payment type not found',
                404,
                null
            );
        }
    }
}
