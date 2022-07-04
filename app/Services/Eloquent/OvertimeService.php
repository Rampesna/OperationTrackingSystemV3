<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IOvertimeService;
use App\Models\Eloquent\Overtime;

class OvertimeService implements IOvertimeService
{
    public function getAll()
    {
        return Overtime::all();
    }

    public function getById(
        int $id
    )
    {
        return Overtime::with([
            'type',
            'status',
            'employee',
        ])->find($id);
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
        string $startDate,
        string $endDate,
        string $description
    )
    {
        $overtime = new Overtime;
        $overtime->employee_id = $employeeId;
        $overtime->type_id = $typeId;
        $overtime->status_id = $statusId;
        $overtime->start_date = $startDate;
        $overtime->end_date = $endDate;
        $overtime->description = $description;
        $overtime->save();

        return $overtime;
    }

    public function update(
        int    $id,
        int    $employeeId,
        int    $typeId,
        int    $statusId,
        string $startDate,
        string $endDate,
        string $description
    )
    {
        $overtime = Overtime::find($id);
        $overtime->employee_id = $employeeId;
        $overtime->type_id = $typeId;
        $overtime->status_id = $statusId;
        $overtime->start_date = $startDate;
        $overtime->end_date = $endDate;
        $overtime->description = $description;
        $overtime->save();

        return $overtime;
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
        return Overtime::with([
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
            })->get();
    }
}
