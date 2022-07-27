<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IOvertimeService;
use App\Models\Eloquent\Overtime;
use App\Services\ServiceResponse;

class OvertimeService implements IOvertimeService
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
            return $overtime;
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
            return $overtime;
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
            $overtimes = Overtime::with([
                'employee',
                'status',
                'type'
            ])->whereIn('employee_id', $employeesByCompanyIdsResponse->getData()->pluck('id')->toArray())
                ->where('status_id', $statusId)
                ->get();

            return new ServiceResponse(
                true,
                'Overtimes on date',
                200,
                $overtimes
            );
        } else {
            return $employeesByCompanyIdsResponse;
        }
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param string|null $startDate
     * @param string|null $endDate
     * @param int|null $statusId
     * @param int|null $typeId
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array   $companyIds,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword,
        ?string $startDate,
        ?string $endDate,
        ?int    $statusId,
        ?int    $typeId
    ): ServiceResponse
    {
        $employeesByCompanyIdsResponse = $this->employeeService->getByCompanyIds(
            0,
            1000,
            $companyIds,
            0,
            $keyword
        );
        if ($employeesByCompanyIdsResponse->isSuccess()) {
            $overtimes = Overtime::with([
                'employee',
                'status',
                'type'
            ])->orderBy('id', 'desc')->whereIn('employee_id', $employeesByCompanyIdsResponse->getData()->pluck('id')->toArray());
            if ($startDate) {
                $overtimes->where('start_date', '>=', $startDate);
            }

            if ($endDate) {
                $overtimes->where('end_date', '<=', $endDate);
            }

            if ($statusId) {
                $overtimes->where('status_id', $statusId);
            }

            if ($typeId) {
                $overtimes->where('type_id', $typeId);
            }

            return new ServiceResponse(
                true,
                'Overtimes',
                200,
                [
                    'totalCount' => $overtimes->count(),
                    'pageIndex' => $pageIndex,
                    'pageSize' => $pageSize,
                    'overtimes' => $overtimes->skip($pageSize * $pageIndex)
                        ->take($pageSize)
                        ->get()
                ]
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
            $overtimes = Overtime::with([
                'employee',
                'status',
                'type'
            ])->whereIn('employee_id', $employeesByCompanyIdsResponse->getData()->pluck('id')->toArray())
                ->where(function ($overtimes) use ($date) {
                    $overtimes->whereBetween('start_date', [
                        $date . ' 00:00:00',
                        $date . ' 23:59:59'
                    ])->orWhereBetween('end_date', [
                        $date . ' 00:00:00',
                        $date . ' 23:59:59'
                    ])->orWhere(function ($overtimes) use ($date) {
                        $overtimes->where('start_date', '<=', $date)->where('end_date', '>=', $date);
                    });
                })
                ->where('status_id', 2)
                ->get();

            return new ServiceResponse(
                true,
                'Overtimes on date',
                200,
                $overtimes
            );
        } else {
            return $employeesByCompanyIdsResponse;
        }
    }

    /**
     * @param int $overtimeId
     * @param int $statusId
     *
     * @return ServiceResponse
     */
    public function setStatus(
        int $overtimeId,
        int $statusId
    ): ServiceResponse
    {
        $overtime = $this->getById($overtimeId);
        if ($overtime->isSuccess()) {
            $overtime->getData()->status_id = $statusId;
            $overtime->getData()->save();

            return new ServiceResponse(
                true,
                'Overtime status updated',
                200,
                $overtime->getData()
            );
        } else {
            return $overtime;
        }
    }
}
