<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPermitService;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Permit;
use App\Models\Eloquent\PermitStatus;
use App\Models\Eloquent\Position;
use App\Services\ServiceResponse;
use Illuminate\Support\Carbon;

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
            ])->whereIn('employee_id', collect($employeesByCompanyIdsResponse->getData()['employees'])->pluck('id')->toArray())
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
            ])->whereIn('employee_id', collect($employeesByCompanyIdsResponse->getData()['employees'])->pluck('id')->toArray())
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

    /**
     * @param array $employeeIds
     * @param array $permitTypeIds
     *
     * @return ServiceResponse
     */
    public function calculateAnnualPermit2(
        array $employeeIds,
        array $permitTypeIds
    ): ServiceResponse
    {
        $response = [];
        foreach ($employeeIds as $employeeId) {
            $position = Position::orderBy('start_date', 'desc')->where('employee_id', $employeeId)->where('end_date', null)->first();
            if ($position) {
                $today = date('Y-m-d');

                $calculateStartDate = $position->start_date;
                while (date('Y-m-d', strtotime($calculateStartDate . ' +1 year')) < $today) {
                    $calculateStartDate = date('Y-m-d', strtotime($calculateStartDate . ' +1 year'));
                }

                $calculateEndDate = date('Y-m-d', strtotime($calculateStartDate . ' +1 year'));

                $permits = Permit::where('employee_id', $employeeId)->whereIn('type_id', $permitTypeIds)->whereBetween('start_date', [
                    $calculateStartDate . ' 00:00:00',
                    $calculateEndDate . ' 23:59:59'
                ])->get();

                $totalDurationOfMinutes = 0;
                foreach ($permits as $permit) {
                    $totalDurationOfMinutes += calculateMinutes($permit->start_date, $permit->end_date);
                }

                $response[] = [
                    'name' => Employee::find($employeeId)->name,
                    'date' => date('Y-m-d', strtotime($calculateEndDate . ' +' . (intval($totalDurationOfMinutes / 480) + 1) . ' day')),
                ];
            }
        }

        return new ServiceResponse(
            true,
            'Calculated annual permit',
            200,
            $response
        );
    }

    /**
     * @param array $employeeIds
     * @param array $permitTypeIds
     *
     * @return ServiceResponse
     */
    public function calculateAnnualPermit(
        array $employeeIds,
        array $permitTypeIds
    ): ServiceResponse
    {
        $annualPermitList = [];
        $employees = Employee::whereIn('id', $employeeIds)->get();
        foreach ($employees as $employee) {
            $position = Position::orderBy('start_date', 'desc')->where('employee_id', $employee->id)->where('end_date', null)->first();

            $startYear = intval(date('Y', strtotime($position->start_date)));
            $endYear = date('2000-m-d', strtotime($position->start_date)) < date('2000-m-d') ? intval(date('Y')) + 1 : intval(date('Y'));

            for ($yearCounter = $startYear; $yearCounter <= $endYear; $yearCounter++) {
                $start = $yearCounter . date('-m-d', strtotime($position->start_date));
                $end = Carbon::createFromDate($start)->addYear()->toDateString();
                $permits = Permit::where('employee_id', $employee->id)->whereIn('type_id', $permitTypeIds)->
                where(function ($permits) use ($start, $end) {
                    $permits->whereBetween('start_date', [
                        $start,
                        $end
                    ])->orWhereBetween('end_date', [
                        $start,
                        $end
                    ])->orWhere(function ($permits) use ($start, $end) {
                        $permits->where('start_date', '<=', $start)->where('end_date', '>=', $end);
                    });
                })->get();
                $totalMinutes = 0;
                foreach ($permits as $permit) {
                    $totalMinutes += calculateMinutes($permit->start_date, $permit->end_date);
                }

                $days = intval($totalMinutes / 480);

                $annualPermitList[] = [
                    'name' => $employee->name,
                    'date' => Carbon::createFromDate($end)->addDays($days)->toDateString(),
                ];
            }
        }

        return new ServiceResponse(
            true,
            'Calculated annual permit',
            200,
            $annualPermitList
        );
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
            $permits = Permit::with([
                'employee',
                'status',
                'type'
            ])->orderBy('id', 'desc')->whereIn('employee_id', collect($employeesByCompanyIdsResponse->getData()['employees'])->pluck('id')->toArray());

            if ($startDate) {
                $permits->where('start_date', '>=', $startDate);
            }

            if ($endDate) {
                $permits->where('start_date', '<=', $endDate);
            }

            if ($statusId) {
                $permits->where('status_id', $statusId);
            }

            if ($typeId) {
                $permits->where('type_id', $typeId);
            }

            return new ServiceResponse(
                true,
                'Permits',
                200,
                [
                    'totalCount' => $permits->count(),
                    'pageIndex' => $pageIndex,
                    'pageSize' => $pageSize,
                    'permits' => $pageSize == -1 ? $permits->get() : $permits->skip($pageSize * $pageIndex)
                        ->take($pageSize)
                        ->get()
                ]
            );
        } else {
            return $employeesByCompanyIdsResponse;
        }
    }

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetweenAndCompanyIds(
        array  $companyIds,
        string $startDate,
        string $endDate
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
            ])->orderBy('id', 'desc')->whereIn('employee_id', collect($employeesByCompanyIdsResponse->getData()['employees'])->pluck('id')->toArray());

            $permits->where(function ($permits) use ($startDate, $endDate) {
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
            });

            return new ServiceResponse(
                true,
                'Permits',
                200,
                $permits->get()
            );
        } else {
            return $employeesByCompanyIdsResponse;
        }
    }

    /**
     * @param int $employeeId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $startDate
     * @param string|null $endDate
     * @param int|null $statusId
     * @param int|null $typeId
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int     $employeeId,
        int     $pageIndex,
        int     $pageSize,
        ?string $startDate,
        ?string $endDate,
        ?int    $statusId,
        ?int    $typeId
    ): ServiceResponse
    {
        $permits = Permit::with([
            'employee',
            'status',
            'type'
        ])->orderBy('id', 'desc')->where('employee_id', $employeeId);

        if ($startDate) {
            $permits->where('start_date', '>=', $startDate);
        }

        if ($endDate) {
            $permits->where('end_date', '<=', $endDate);
        }

        if ($statusId) {
            $permits->where('status_id', $statusId);
        }

        if ($typeId) {
            $permits->where('type_id', $typeId);
        }

        return new ServiceResponse(
            true,
            'Permits',
            200,
            [
                'totalCount' => $permits->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'permits' => $permits->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param array $employeeIds
     * @param array $typeIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetweenByEmployeeIdsAndTypeIds(
        array  $employeeIds,
        array  $typeIds,
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $permits = Permit::with([
            'employee'
        ])->whereIn('employee_id', $employeeIds)->whereIn('type_id', $typeIds)->where(function ($permits) use ($startDate, $endDate) {
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
        })->where('status_id', 2)->get();

        return new ServiceResponse(
            true,
            'Permits',
            200,
            $permits
        );
    }

    /**
     * @param int $permitId
     * @param int $statusId
     *
     * @return ServiceResponse
     */
    public function setStatus(
        int $permitId,
        int $statusId
    ): ServiceResponse
    {
        $permit = $this->getById($permitId);
        if ($permit->isSuccess()) {
            $permit->getData()->status_id = $statusId;
            $permit->getData()->save();

            if ($statusId == 2 || $statusId == 3) {
                $heading = 'İzin Talebi';
                $message = 'İzin Talebiniz ' . PermitStatus::find($statusId)->name;

                $notificationService = new NotificationService;
                $notificationCreateResponse = $notificationService->create(
                    'App\\Models\\Eloquent\\Employee',
                    $permit->getData()->employee_id,
                    $heading,
                    $message,
                );

                if ($notificationCreateResponse->isSuccess()) {
                    $oneSignalNotificationService = new \App\Services\OneSignal\NotificationService;
                    $oneSignalNotificationService->sendNotification(
                        [
                            $permit->getData()->employee->device_token ?? ''
                        ],
                        $heading,
                        $message
                    );
                }
            }

            return new ServiceResponse(
                true,
                'Permit status updated',
                200,
                $permit->getData()
            );
        } else {
            return $permit;
        }
    }
}
