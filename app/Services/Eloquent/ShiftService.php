<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICompanyService;
use App\Interfaces\Eloquent\ISaturdayPermitService;
use App\Interfaces\Eloquent\IShiftGroupEmployeeUseListService;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Interfaces\Eloquent\IShiftService;
use App\Models\Eloquent\Shift;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Services\ServiceResponse;
use Illuminate\Support\Carbon;

class ShiftService implements IShiftService
{
    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @var $companyService
     */
    private $companyService;

    /**
     * @var $shiftGroupService
     */
    private $shiftGroupService;

    /**
     * @var $shiftGroupEmployeeUseListService
     */
    private $shiftGroupEmployeeUseListService;

    /**
     * @var $saturdayPermitService
     */
    private $saturdayPermitService;

    /**
     * @param IEmployeeService $employeeService
     * @param ICompanyService $companyService
     * @param IShiftGroupService $shiftGroupService
     * @param IShiftGroupEmployeeUseListService $shiftGroupEmployeeUseListService
     * @param ISaturdayPermitService $saturdayPermitService
     */
    public function __construct(
        IEmployeeService                  $employeeService,
        ICompanyService                   $companyService,
        IShiftGroupService                $shiftGroupService,
        IShiftGroupEmployeeUseListService $shiftGroupEmployeeUseListService,
        ISaturdayPermitService            $saturdayPermitService
    )
    {
        $this->employeeService = $employeeService;
        $this->companyService = $companyService;
        $this->shiftGroupService = $shiftGroupService;
        $this->shiftGroupEmployeeUseListService = $shiftGroupEmployeeUseListService;
        $this->saturdayPermitService = $saturdayPermitService;
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
            'shiftGroup',
            'employee'
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
            $employeesByCompanyIdsResponse = $this->employeeService->getByCompanyIds(0, 1000, [$companyId]);

            if ($employeesByCompanyIdsResponse->isSuccess()) {
                $employees = collect($employeesByCompanyIdsResponse->getData()['employees']);

                if ($keyword) {
                    $employees = $employees->where('name', 'like', '%' . $keyword . '%')->all();
                }

                if ($jobDepartmentIds) {
                    $employees = $employees->whereIn('job_department_id', $jobDepartmentIds)->all();
                }

                $shifts->whereIn('employee_id', $employees->pluck('id')->toArray());
            } else {
                return $employeesByCompanyIdsResponse;
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
     * @param int $employeeId
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int    $employeeId,
        string $startDate,
        string $endDate,
    ): ServiceResponse
    {
        $shifts = Shift::with([
            'employee',
            'shiftGroup'
        ])->where('employee_id', $employeeId)
            ->whereBetween('start_date', [$startDate, $endDate]);

        return new ServiceResponse(
            true,
            'Shifts',
            200,
            $shifts->get()
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
                collect($this->employeeService->getByCompanyIds(0, 1000, $companyIds, 0, $keyword, $jobDepartmentIds)->getData()['employees'])->pluck('id')->toArray()
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
     * @param array $shifts {
     * @param int $employeeId
     * @param int $shiftGroupId
     * @param string $startDate
     * @param string $endDate
     * }
     * @param int $authUserId
     *
     * @return ServiceResponse
     */
    public function createBatch(
        array $shifts,
        int   $authUserId
    ): ServiceResponse
    {
        $shiftsForCreate = [];
        foreach ($shifts as $shift) {
            $employeeResponse = $this->employeeService->getById($shift['employeeId']);
            if ($employeeResponse->isSuccess()) {
                $shiftsForCreate[] = [
                    'company_id' => $employeeResponse->getData()->company_id,
                    'employee_id' => $shift['employeeId'],
                    'shift_group_id' => $shift['shiftGroupId'],
                    'created_by' => $authUserId,
                    'last_updated_by' => $authUserId,
                    'start_date' => $shift['startDate'],
                    'end_date' => $shift['endDate'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }

        return new ServiceResponse(
            true,
            'Shifts created',
            201,
            Shift::insert($shiftsForCreate)
        );
    }

    /**
     * @param int $id
     * @param int $shiftGroupId
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $shiftGroupId,
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $shift = $this->getById($id);
        if ($shift->isSuccess()) {
            $shift->getData()->shift_group_id = $shiftGroupId;
            $shift->getData()->start_date = $startDate;
            $shift->getData()->end_date = $endDate;
            $shift->getData()->save();

            return new ServiceResponse(
                true,
                'Shift updated',
                200,
                $shift->getData()
            );
        } else {
            return $shift;
        }
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
        $allCompanies = $this->companyService->getAll()->getData();
        foreach ($allCompanies as $company) {
            if ($company->saturday_permit_service === 1) {
                $this->saturdayPermitService->robot(
                    $month,
                    $company->id
                );
            }
        }
        $this->shiftGroupEmployeeUseListService->initialize();
        $shiftGroups = $this->shiftGroupService->getByCompanyId($companyId);
        $shifts = collect();

        foreach ($shiftGroups->getData() as $shiftGroup) {
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

                            $saturdayPermit = $this->saturdayPermitService->getByEmployeeIdAndDate($employee->id, $date);
                            if ($saturdayPermit->isSuccess()) {
                                if ($saturdayPermit->getData()->status == 'on') {
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

                            $unavailableEmployeeIds = [];
                            $usedShiftGroupEmployees = $this->shiftGroupEmployeeUseListService->getUsedShiftGroupEmployees($shiftGroup->id);
                            $unavailableEmployeeIds = array_merge($unavailableEmployeeIds, $usedShiftGroupEmployees->getData()->pluck('id')->toArray());
//                            $saturdayPermitEmployeesResponse = $this->saturdayPermitService->getByDate(date('Y-m-d', strtotime('next saturday', strtotime($date))));
//                            if ($saturdayPermitEmployeesResponse->isSuccess()) {
//                                $unavailableEmployeeIds = array_merge($unavailableEmployeeIds, $saturdayPermitEmployeesResponse->getData()->pluck('employee_id')->toArray());
//                            }

                            if ($weeklyEmployees->count() < $shiftGroup->per_day) {
                                $shiftGroupEmployees = $shiftGroup->employees()->whereNotIn('id', $unavailableEmployeeIds)->get();
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
                                    $saturdayPermit = $this->saturdayPermitService->getByEmployeeIdAndDate($employee->id, $date);
                                    if ($saturdayPermit->isSuccess()) {
                                        if ($saturdayPermit->getData()->status == 'on') {
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
                            } else {
                                $weeklyEmployees = collect();
                                $continueForNextWeek = true;
                                goto checkWeeklyEmployees;
                            }
                        } else {
                            $unavailableEmployeeIds = [];
                            $usedShiftGroupEmployees = $this->shiftGroupEmployeeUseListService->getUsedShiftGroupEmployees($shiftGroup->id);
                            $unavailableEmployeeIds = array_merge($unavailableEmployeeIds, $usedShiftGroupEmployees->getData()->pluck('id')->toArray());
//                            $saturdayPermitEmployeesResponse = $this->saturdayPermitService->getByDate(date('Y-m-d', strtotime('next saturday', strtotime($date))));
//                            if ($saturdayPermitEmployeesResponse->isSuccess()) {
//                                $unavailableEmployeeIds = array_merge($unavailableEmployeeIds, $saturdayPermitEmployeesResponse->getData()->pluck('employee_id')->toArray());
//                            }
                            $shiftGroupEmployees = $shiftGroup->employees()->whereNotIn('id', $unavailableEmployeeIds)->get();
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
                                $saturdayPermit = $this->saturdayPermitService->getByEmployeeIdAndDate($employee->id, $date);
                                if (!$saturdayPermit->isSuccess()) {
                                    if ($saturdayPermit->getData()->status == 'on') {
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
                                    } else {
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
            }
        }

        Shift::insert($shifts->toArray());

        return new ServiceResponse(
            true,
            'Shift robot completed successfully.',
            201,
            $shifts->toArray()
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
