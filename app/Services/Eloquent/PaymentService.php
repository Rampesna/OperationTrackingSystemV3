<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IPaymentService;
use App\Models\Eloquent\Payment;
use App\Services\ServiceResponse;

class PaymentService implements IPaymentService
{
    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @param IEmployeeService $employeeService
     */
    public function __construct(IEmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All payments',
            200,
            Payment::all()
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
        $payment = Payment::with([
            'type',
            'status',
            'employee',
        ])->find($id);
        if ($payment) {
            return new ServiceResponse(
                true,
                'Payment',
                200,
                $payment
            );
        } else {
            return new ServiceResponse(
                false,
                'Payment not found',
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
        $payment = $this->getById($id);
        if ($payment->isSuccess()) {
            return new ServiceResponse(
                true,
                'Payment deleted',
                200,
                $payment->getData()->delete()
            );
        } else {
            return $payment;
        }
    }

    /**
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $date
     * @param int $amount
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function create(
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $date,
        int    $amount,
        string $description
    ): ServiceResponse
    {
        $payment = new Payment;
        $payment->employee_id = $employeeId;
        $payment->type_id = $typeId;
        $payment->status_id = $statusId;
        $payment->date = $date;
        $payment->amount = $amount;
        $payment->description = $description;
        $payment->save();

        return new ServiceResponse(
            true,
            'Payment created',
            201,
            $payment
        );
    }

    /**
     * @param int $id
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $date
     * @param int $amount
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $date,
        int    $amount,
        string $description
    ): ServiceResponse
    {
        $payment = $this->getById($id);
        if ($payment->isSuccess()) {
            $payment->getData()->employee_id = $employeeId;
            $payment->getData()->type_id = $typeId;
            $payment->getData()->status_id = $statusId;
            $payment->getData()->date = $date;
            $payment->getData()->amount = $amount;
            $payment->getData()->description = $description;
            $payment->getData()->save();

            return new ServiceResponse(
                true,
                'Payment updated',
                200,
                $payment->getData()
            );
        } else {
            return $payment;
        }
    }

    /**
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        int    $employeeId,
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Payments between dates',
            200,
            Payment::with([
                'status',
                'type'
            ])->where('employee_id', $employeeId)->whereBetween('date', [$startDate, $endDate])->get()
        );
    }

    /**
     * @param int $statusId
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function getByStatusIdAndCompanyIds(
        int   $statusId,
        array $companyIds
    ): ServiceResponse
    {
        $employeesByCompanyIdsResponse = $this->employeeService->getByCompanyIds(
            0,
            1000,
            $companyIds
        );
        if ($employeesByCompanyIdsResponse->isSuccess()) {
            $payments = Payment::with([
                'employee',
                'status',
                'type'
            ])->whereIn('employee_id', $employeesByCompanyIdsResponse->getData()->pluck('id')->toArray())
                ->where('status_id', $statusId)
                ->get();

            return new ServiceResponse(
                true,
                'Payments on date',
                200,
                $payments
            );
        } else {
            return $employeesByCompanyIdsResponse;
        }
    }

    /**
     * @param string $date
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function getByDateAndCompanyIds(
        string $date,
        array  $companyIds
    ): ServiceResponse
    {
        $employeesByCompanyIdsResponse = $this->employeeService->getByCompanyIds(
            0,
            1000,
            $companyIds
        );
        if ($employeesByCompanyIdsResponse->isSuccess()) {
            $payments = Payment::with([
                'employee',
                'status',
                'type'
            ])->whereIn('employee_id', $employeesByCompanyIdsResponse->getData()->pluck('id')->toArray())
                ->where('date', $date)
                ->where('status_id', 2)
                ->get();

            return new ServiceResponse(
                true,
                'Payments on date',
                200,
                $payments
            );
        } else {
            return $employeesByCompanyIdsResponse;
        }
    }

    /**
     * @param int $paymentId
     * @param int $statusId
     *
     * @return ServiceResponse
     */
    public function setStatus(
        int $paymentId,
        int $statusId
    ): ServiceResponse
    {
        $payment = $this->getById($paymentId);
        if ($payment->isSuccess()) {
            $payment->getData()->status_id = $statusId;
            $payment->getData()->save();

            return new ServiceResponse(
                true,
                'Payment status updated',
                200,
                $payment->getData()
            );
        } else {
            return $payment;
        }
    }
}
