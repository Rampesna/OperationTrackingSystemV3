<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPaymentTypeService;
use App\Models\Eloquent\PaymentType;

class PaymentTypeService implements IPaymentTypeService
{
    public function getAll()
    {
        return PaymentType::all();
    }

    public function getById(
        int $id
    )
    {
        return PaymentType::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }
}
