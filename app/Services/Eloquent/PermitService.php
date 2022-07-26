<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPermitService;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Models\Eloquent\Permit;
use App\Services\ServiceResponse;

class PermitService implements IPermitService
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
            'All permits',
            200,
            Permit::all()
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
        $permit = Permit::with([
            'type',
            'status',
            'employee',
        ])->find($id);
        if ($permit) {
            return new ServiceResponse(
                true,
                'Permit',
                200,
                $permit
            );
        } else {
            return new ServiceResponse(
                false,
                'Permit not found',
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
        $permit = $this->getById($id);
        if ($permit->isSuccess()) {
            return new ServiceResponse(
                true,
                'Permit deleted',
                200,
                $permit->getData()->delete()
            );
        } else {
            return $permit;
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
        $permit = new Permit;
        $permit->employee_id = $employeeId;
        $permit->type_id = $typeId;
        $permit->status_id = $statusId;
        $permit->start_date = $startDate;
        $permit->end_date = $endDate;
        $permit->description = $description;
        $permit->save();

        return new ServiceResponse(
            true,
            'Permit created',
            201,
            $permit
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
        $permit = $this->getById($id);
        if ($permit->isSuccess()) {
            $permit->getData()->employee_id = $employeeId;
            $permit->getData()->type_id = $typeId;
            $permit->getData()->status_id = $statusId;
            $permit->getData()->start_date = $startDate;
            $permit->getData()->end_date = $endDate;
            $permit->getData()->description = $description;
            $permit->getData()->save();

            return new ServiceResponse(
                true,
                'Permit updated',
                200,
                $permit->getData()
            );
        } else {
            return $permit;
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
            'Permits between dates',
            200,
            Permit::with([
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
            $permits = Permit::with([
                'employee',
                'status',
                'type'
            ])->whereIn('employee_id', $employeesByCompanyIdsResponse->getData()->pluck('id')->toArray())
                ->where('status_id', $statusId)
                ->get();

            return new ServiceResponse(
                true,
                'Permits on date',
                200,
                $permits
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
            $permits = Permit::with([
                'employee',
                'status',
                'type'
            ])->whereIn('employee_id', $employeesByCompanyIdsResponse->getData()->pluck('id')->toArray())
                ->where(function ($permits) use ($date) {
                    $permits->whereBetween('start_date', [
                        $date . ' 00:00:00',
                        $date . ' 23:59:59'
                    ])->orWhereBetween('end_date', [
                        $date . ' 00:00:00',
                        $date . ' 23:59:59'
                    ])->orWhere(function ($permits) use ($date) {
                        $permits->where('start_date', '<=', $date)->where('end_date', '>=', $date);
                    });
                })
                ->where('status_id', 2)
                ->get();

            return new ServiceResponse(
                true,
                'Permits on date',
                200,
                $permits
            );
        } else {
            return $employeesByCompanyIdsResponse;
        }
    }
}
