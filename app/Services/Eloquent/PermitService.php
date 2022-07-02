<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPermitService;
use App\Models\Eloquent\Permit;

class PermitService implements IPermitService
{
    public function getAll()
    {
        return Permit::all();
    }

    public function getById(
        int $id
    )
    {
        return Permit::find($id);
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
        $permit = new Permit;
        $permit->employee_id = $employeeId;
        $permit->type_id = $typeId;
        $permit->status_id = $statusId;
        $permit->start_date = $startDate;
        $permit->end_date = $endDate;
        $permit->description = $description;
        $permit->save();

        return $permit;
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
        return Permit::with([
            'status',
            'type'
        ])->where('employee_id', $employeeId)
            ->where(function ($permits) use ($startDate, $endDate) {
                $permits->whereBetween('start_date', [
                    $startDate . ' 00:00:00',
                    $endDate . ' 23:59:59'
                ])->
                orWhere(function ($permits) use ($startDate, $endDate) {
                    $permits->whereBetween('end_date', [
                        $startDate . ' 00:00:00',
                        $endDate . ' 23:59:59'
                    ]);
                })->
                orWhere(function ($permits) use ($startDate, $endDate) {
                    $permits->where('start_date', '<=', $startDate)->where('end_date', '>=', $endDate);
                });
            })->get();
    }
}
