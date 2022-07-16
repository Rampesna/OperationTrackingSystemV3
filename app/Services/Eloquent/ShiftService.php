<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IShiftGroupEmployeeUseListService;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Interfaces\Eloquent\IShiftService;
use App\Models\Eloquent\Shift;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Services\ServiceResponse;
use Illuminate\Support\Carbon;

class ShiftService implements IShiftService
{
    private $employeeService;

    private $shiftGroupService;

    private $shiftGroupEmployeeUseListService;

    /**
     * @param IEmployeeService $employeeService
     * @param IShiftGroupService $shiftGroupService
     * @param IShiftGroupEmployeeUseListService $shiftGroupEmployeeUseListService
     */
    public function __construct(
        IEmployeeService                  $employeeService,
        IShiftGroupService                $shiftGroupService,
        IShiftGroupEmployeeUseListService $shiftGroupEmployeeUseListService
    )
    {
        $this->employeeService = $employeeService;
        $this->shiftGroupService = $shiftGroupService;
        $this->shiftGroupEmployeeUseListService = $shiftGroupEmployeeUseListService;
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All Shifts',
            200,
            Shift::all()
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
        $shift = Shift::with([
            'shiftGroup'
        ])->find($id);
        if ($shift) {
            return new ServiceResponse(
                true,
                'Shift',
                200,
                $shift
            );
        } else {
            return new ServiceResponse(
                false,
                'Shift not found',
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
        $shift = $this->getById($id);
        if ($shift->isSuccess()) {
            return new ServiceResponse(
                true,
                'Shift deleted',
                200,
                $shift->getData()->delete()
            );
        } else {
            return $shift;
        }
    }

    /**
     * @param int $companyId
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyId(
        int         $companyId,
        string      $startDate,
        string      $endDate,
        string|null $keyword = null,
        array|null  $jobDepartmentIds
    ): ServiceResponse
    {
        $shifts = Shift::with([
            'employee',
            'shiftGroup'
        ])->where('company_id', $companyId)
            ->whereBetween('start_date', [$startDate, $endDate])
            ->get();

        if ($keyword || $jobDepartmentIds) {
            $employees = $this->employeeService->getByCompanyIds(0, 1000, [$companyId]);

            if ($employees->isSuccess()) {
                $employees = $employees->getData();

                if ($keyword) {
                    $employees = $employees->where('name', 'like', '%' . $keyword . '%')->all();
                }

                if ($jobDepartmentIds) {
                    $employees = $employees->whereIn('job_department_id', $jobDepartmentIds)->all();
                }

                $shifts->whereIn('employee_id', $employees->pluck('id')->toArray());
            } else {
                return $employees;
            }
        }

        return new ServiceResponse(
            true,
            'Shifts',
            200,
            $shifts
        );
    }

    /**
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetweenByEmployeeId(
        int    $employeeId,
        string $startDate,
        string $endDate,
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Shifts',
            200,
            Shift::with([
                'shiftGroup' => function ($shiftGroup) {
                    $shiftGroup->select([
                        'id',
                        'name'
                    ]);
                }
            ])->where('employee_id', $employeeId)->whereBetween('start_date', [$startDate, $endDate])->get()
        );
    }

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     * @param array|null $shiftGroupIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array       $companyIds,
        string      $startDate,
        string      $endDate,
        string|null $keyword = null,
        array|null  $jobDepartmentIds,
        array|null  $shiftGroupIds
    ): ServiceResponse
    {
        $shifts = Shift::with([
            'employee',
            'shiftGroup'
        ])->whereIn('company_id', $companyIds)
            ->whereBetween('start_date', [$startDate, $endDate]);

        if ($keyword || $jobDepartmentIds) {
            $shifts->whereIn(
                'employee_id',
                $this->employeeService->getByCompanyIds(0, 1000, $companyIds, 0, $keyword, $jobDepartmentIds)->getData()->pluck('id')->toArray()
            );
        }

        if ($shiftGroupIds && count($shiftGroupIds) > 0) {
            $shifts->whereIn('shift_group_id', $shiftGroupIds);
        }

        return new ServiceResponse(
            true,
            'Shifts',
            200,
            $shifts->get()
        );
    }

    /**
     * @param int $companyId
     * @param string $month
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function robot(
        int    $companyId,
        string $month,
        int    $userId
    ): ServiceResponse
    {
        $this->shiftGroupEmployeeUseListService->initialize();
        $shiftGroups = $this->shiftGroupService->getByCompanyId($companyId);
        $shifts = collect();

        foreach ($shiftGroups as $shiftGroup) {
            $startDayOfMonth = 1;
            $endDayOfMonth = date('t', strtotime($month));
            $weeklyEmployees = collect();
            $randomEmployees = collect();
            $continueForNextWeek = false;
            $checkNewMonthFirstDate = false;

            for ($day = $startDayOfMonth; $day <= $endDayOfMonth; $day++) {
                $date = $month . '-' . sprintf('%02d', $day);
                $dayControlVariable = 'day' . date('w', strtotime($date));
                $dayShiftGroupStartTimeVariable = $dayControlVariable . '_start_time';
                $dayShiftGroupEndTimeVariable = $dayControlVariable . '_end_time';

                if ($shiftGroup->$dayControlVariable === 1) {
                    if ($shiftGroup->add_type === 1) {
                        foreach ($shiftGroup->employees as $employee) {
                            if ($shiftGroup->delete_if_exist === 1) {
                                $getShiftKeysForDelete = $shifts->where('employee_id', $employee->id)
                                    ->whereBetween('start_date', [
                                        $date . ' 00:00:00',
                                        $date . ' 23:59:59'
                                    ])->keys();
                                if (count($getShiftKeysForDelete) > 0) {
                                    foreach ($getShiftKeysForDelete as $key) {
                                        $shifts->forget($key);
                                    }
                                }
                            }
                            if ($dayControlVariable == 'day0' && $shiftGroup->week_permit === 1) {
                                $getShiftKeysForDelete = $shifts->where('employee_id', $employee->id)
                                    ->whereBetween('start_date', [
                                        date('Y-m-d', strtotime('-7 days', strtotime('+' . $shiftGroup->number_of_week_permit_day . ' days', strtotime($date)))) . ' 00:00:00',
                                        date('Y-m-d', strtotime('-7 days', strtotime('+' . $shiftGroup->number_of_week_permit_day . ' days', strtotime($date)))) . ' 23:59:59'
                                    ])->keys();
                                if (count($getShiftKeysForDelete) > 0) {
                                    foreach ($getShiftKeysForDelete as $key) {
                                        $shifts->forget($key);
                                    }
                                }
                            }
                            $shifts->push([
                                'company_id' => $employee->company_id,
                                'employee_id' => $employee->id,
                                'shift_group_id' => $shiftGroup->id,
                                'created_by' => $userId,
                                'last_updated_by' => $userId,
                                'deleted_by' => null,
                                'start_date' => $date . ' ' . $shiftGroup->$dayShiftGroupStartTimeVariable,
                                'end_date' => $date . ' ' . $shiftGroup->$dayShiftGroupEndTimeVariable,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                        }
                    } else {
                        if ($shiftGroup->set_group_weekly === 1) {
                            checkWeeklyEmployees:
                            if ($day == 1 && $dayControlVariable != 'day1') {
                                $weeklyEmployees = $this->employeeService->getByIds(
                                    Shift::where('shift_group_id', $shiftGroup->id)
                                        ->orderBy('id', 'desc')
                                        ->limit($shiftGroup->per_day)
                                        ->pluck('employee_id')
                                        ->toArray()
                                );

                                if ($weeklyEmployees->getData()->count() < $shiftGroup->per_day) {
                                    $weeklyEmployees = collect();
                                }
                            }

                            $usedShiftGroupEmployees = $this->shiftGroupEmployeeUseListService->getUsedShiftGroupEmployees($shiftGroup->id);

                            if ($weeklyEmployees->count() < $shiftGroup->per_day) {
                                $shiftGroupEmployees = $shiftGroup->employees()->whereNotIn('id', $usedShiftGroupEmployees->getData()->pluck('id')->toArray())->get();
                                $weeklyEmployees = $shiftGroupEmployees->random($shiftGroup->per_day);

                                if ($weeklyEmployees->count() < $shiftGroup->per_day) {
                                    $this->shiftGroupEmployeeUseListService->setShiftGroupEmployeesNotUsed($shiftGroup->id);
                                    $shiftGroupEmployees = $shiftGroup->employees;
                                    $weeklyEmployees = $shiftGroupEmployees->random($shiftGroup->per_day);

                                    if ($weeklyEmployees->count() < $shiftGroup->per_day) {
                                        return new ServiceResponse(
                                            false,
                                            'Not enough employees for shift group',
                                            400,
                                            $shiftGroup->name . ' - Vardiya Grubunda Yeterli Personel Yok!'
                                        );
                                    }
                                }
                            }

                            $todayWeekOfYear = Carbon::createFromDate(date('Y-m-d', strtotime($date)))->weekOfYear;
                            $yesterdayWeekOfYear = Carbon::createFromDate(date('Y-m-d', strtotime('-1 day', strtotime($date))))->weekOfYear;

                            if ($todayWeekOfYear == $yesterdayWeekOfYear || $continueForNextWeek == true) {
                                $continueForNextWeek = false;
                                foreach ($weeklyEmployees as $employee) {
                                    if ($shiftGroup->delete_if_exist === 1) {
                                        $getShiftKeysForDelete = $shifts->where('employee_id', $employee->id)
                                            ->whereBetween('start_date', [
                                                $date . ' 00:00:00',
                                                $date . ' 23:59:59'
                                            ])->keys();
                                        if (count($getShiftKeysForDelete) > 0) {
                                            foreach ($getShiftKeysForDelete as $key) {
                                                $shifts->forget($key);
                                            }
                                        }
                                    }
                                    if ($dayControlVariable == 'day0' && $shiftGroup->week_permit === 1) {
                                        $getShiftKeysForDelete = $shifts->where('employee_id', $employee->id)
                                            ->whereBetween('start_date', [
                                                date('Y-m-d', strtotime('-7 days', strtotime('+' . $shiftGroup->number_of_week_permit_day . ' days', strtotime($date)))) . ' 00:00:00',
                                                date('Y-m-d', strtotime('-7 days', strtotime('+' . $shiftGroup->number_of_week_permit_day . ' days', strtotime($date)))) . ' 23:59:59'
                                            ])->keys();
                                        if (count($getShiftKeysForDelete) > 0) {
                                            foreach ($getShiftKeysForDelete as $key) {
                                                $shifts->forget($key);
                                            }
                                        }
                                    }
                                    $this->shiftGroupEmployeeUseListService->setUsedShiftGroupEmployee($shiftGroup->id, $employee->id);
                                    $shifts->push([
                                        'company_id' => $employee->company_id,
                                        'employee_id' => $employee->id,
                                        'shift_group_id' => $shiftGroup->id,
                                        'created_by' => $userId,
                                        'last_updated_by' => $userId,
                                        'deleted_by' => null,
                                        'start_date' => $date . ' ' . $shiftGroup->$dayShiftGroupStartTimeVariable,
                                        'end_date' => $date . ' ' . $shiftGroup->$dayShiftGroupEndTimeVariable,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                                }
                            } else {
                                $weeklyEmployees = collect();
                                $continueForNextWeek = true;
                                goto checkWeeklyEmployees;
                            }
                        } else {
                            $usedShiftGroupEmployees = $this->shiftGroupEmployeeUseListService->getUsedShiftGroupEmployees($shiftGroup->id);
                            $shiftGroupEmployees = $shiftGroup->employees()->whereNotIn('id', $usedShiftGroupEmployees->getData()->pluck('id')->toArray())->get();
                            $randomEmployees = $shiftGroupEmployees->random($shiftGroup->per_day);

                            foreach ($randomEmployees as $employee) {
                                if ($shiftGroup->delete_if_exist === 1) {
                                    $getShiftKeysForDelete = $shifts->where('employee_id', $employee->id)
                                        ->whereBetween('start_date', [
                                            $date . ' 00:00:00',
                                            $date . ' 23:59:59'
                                        ])->keys();
                                    if (count($getShiftKeysForDelete) > 0) {
                                        foreach ($getShiftKeysForDelete as $key) {
                                            $shifts->forget($key);
                                        }
                                    }
                                }
                                if ($dayControlVariable == 'day0' && $shiftGroup->week_permit === 1) {
                                    $getShiftKeysForDelete = $shifts->where('employee_id', $employee->id)
                                        ->whereBetween('start_date', [
                                            date('Y-m-d', strtotime('-7 days', strtotime('+' . $shiftGroup->number_of_week_permit_day . ' days', strtotime($date)))) . ' 00:00:00',
                                            date('Y-m-d', strtotime('-7 days', strtotime('+' . $shiftGroup->number_of_week_permit_day . ' days', strtotime($date)))) . ' 23:59:59'
                                        ])->keys();
                                    if (count($getShiftKeysForDelete) > 0) {
                                        foreach ($getShiftKeysForDelete as $key) {
                                            $shifts->forget($key);
                                        }
                                    }
                                }
                                $this->shiftGroupEmployeeUseListService->setUsedShiftGroupEmployee($shiftGroup->id, $employee->id);
                                $shifts->push([
                                    'company_id' => $employee->company_id,
                                    'employee_id' => $employee->id,
                                    'shift_group_id' => $shiftGroup->id,
                                    'created_by' => $userId,
                                    'last_updated_by' => $userId,
                                    'deleted_by' => null,
                                    'start_date' => $date . ' ' . $shiftGroup->$dayShiftGroupStartTimeVariable,
                                    'end_date' => $date . ' ' . $shiftGroup->$dayShiftGroupEndTimeVariable,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s'),
                                ]);
                            }
                        }
                    }
                }
            }
        }

//        return $shifts;
        Shift::insert($shifts->toArray());

        return new ServiceResponse(
            true,
            'Shift robot completed successfully.',
            201,
            $shifts
        );
    }

    /**
     * @param array $shiftIds
     *
     * @return ServiceResponse
     */
    public function deleteByIds(
        array $shiftIds
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Shift deleted successfully.',
            200,
            Shift::whereIn('id', $shiftIds)->delete()
        );
    }
}
