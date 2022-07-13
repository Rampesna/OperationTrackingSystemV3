<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IOvertimeService;
use App\Models\Eloquent\Overtime;
use App\Services\ServiceResponse;

class OvertimeService implements IOvertimeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All overtimes',
            200,
            Overtime::all()
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
        $overtime = Overtime::with([
            'type',
            'status',
            'employee',
        ])->find($id);
        if ($overtime) {
            return new ServiceResponse(
                true,
                'Overtime',
                200,
                $overtime
            );
        } else {
            return new ServiceResponse(
                false,
                'Overtime not found',
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
        $overtime = $this->getById($id);
        if ($overtime->isSuccess()) {
            return new ServiceResponse(
                true,
                'Overtime deleted',
                200,
                $overtime->getData()->delete()
            );
        } else {
            return new ServiceResponse(
                false,
                'Overtime not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $startDate
     * @param string $endDate
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function create(
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $startDate,
        string $endDate,
        string $description
    ): ServiceResponse
    {
        $overtime = new Overtime;
        $overtime->employee_id = $employeeId;
        $overtime->type_id = $typeId;
        $overtime->status_id = $statusId;
        $overtime->start_date = $startDate;
        $overtime->end_date = $endDate;
        $overtime->description = $description;
        $overtime->save();

        return new ServiceResponse(
            true,
            'Overtime created',
            201,
            $overtime
        );
    }

    /**
     * @param int $id
     * @param int $employeeId
     * @param int $typeId
     * @param int $statusId
     * @param string $startDate
     * @param string $endDate
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $startDate,
        string $endDate,
        string $description
    ): ServiceResponse
    {
        $overtime = $this->getById($id);
        if ($overtime->isSuccess()) {
            $overtime->getData()->employee_id = $employeeId;
            $overtime->getData()->type_id = $typeId;
            $overtime->getData()->status_id = $statusId;
            $overtime->getData()->start_date = $startDate;
            $overtime->getData()->end_date = $endDate;
            $overtime->getData()->description = $description;
            $overtime->getData()->save();

            return new ServiceResponse(
                true,
                'Overtime updated',
                200,
                $overtime->getData()
            );
        } else {
            return new ServiceResponse(
                false,
                'Overtime not found',
                404,
                null
            );
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
            'Overtimes',
            200,
            Overtime::with([
                'status',
                'type'
            ])->where('employee_id', $employeeId)
                ->where(function ($overtimes) use ($startDate, $endDate) {
                    $overtimes->whereBetween('start_date', [
                        $startDate . ' 00:00:00',
                        $endDate . ' 23:59:59'
                    ])->
                    orWhere(function ($overtimes) use ($startDate, $endDate) {
                        $overtimes->whereBetween('end_date', [
                            $startDate . ' 00:00:00',
                            $endDate . ' 23:59:59'
                        ]);
                    })->
                    orWhere(function ($overtimes) use ($startDate, $endDate) {
                        $overtimes->where('start_date', '<=', $startDate)->where('end_date', '>=', $endDate);
                    });
                })->get()
        );
    }
}
