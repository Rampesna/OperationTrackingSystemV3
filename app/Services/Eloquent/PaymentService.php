<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPaymentService;
use App\Models\Eloquent\Payment;

class PaymentService implements IPaymentService
{
    public function getAll()
    {
        return Payment::all();
    }

    public function getById(
        int $id
    )
    {
        return Payment::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function create(
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $date,
        int    $amount,
        string $description
    )
    {
        $payment = new Payment;
        $payment->employee_id = $employeeId;
        $payment->type_id = $typeId;
        $payment->status_id = $statusId;
        $payment->date = $date;
        $payment->amount = $amount;
        $payment->description = $description;
        $payment->save();

        return $payment;
    }

    /**
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     */
    public function getDateBetween(
        int    $employeeId,
        string $startDate,
        string $endDate
    )
    {
        return Payment::with([
            'status',
            'type'
        ])->where('employee_id', $employeeId)->whereBetween('date', [$startDate, $endDate])->get();
    }
}
