<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IShiftGroupService;
use App\Models\Eloquent\ShiftGroup;
use App\Services\ServiceResponse;

class ShiftGroupService implements IShiftGroupService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All shift groups',
            200,
            ShiftGroup::all()
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
        $shiftGroup = ShiftGroup::with([
            'employees'
        ])->find($id);
        if ($shiftGroup) {
            return new ServiceResponse(
                true,
                'Shift group',
                200,
                $shiftGroup
            );
        } else {
            return new ServiceResponse(
                false,
                'Shift group not found',
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
        $shiftGroup = $this->getById($id);
        if ($shiftGroup->isSuccess()) {
            return new ServiceResponse(
                true,
                'Shift group deleted',
                200,
                $shiftGroup->getData()->delete()
            );
        } else {
            return $shiftGroup;
        }
    }

    /**
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function getByCompanyId(
        int $companyId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Shift groups',
            200,
            ShiftGroup::with([
                'employees'
            ])->where('company_id', $companyId)->orderBy('order')->get()
        );
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array       $companyIds,
        int         $pageIndex = 0,
        int         $pageSize = 10,
        string|null $keyword = null
    ): ServiceResponse
    {
        $shiftGroups = ShiftGroup::with([
            'company'
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $shiftGroups->where('name', 'like', '%' . $keyword . '%');
        }

        return new ServiceResponse(
            true,
            'Shift groups',
            200,
            [
                'totalCount' => $shiftGroups->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'shiftGroups' => $shiftGroups->orderBy('order')->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function getShiftGroupEmployees(
        int $shiftGroupId
    ): ServiceResponse
    {
        $shiftGroup = $this->getById($shiftGroupId);
        if ($shiftGroup->isSuccess()) {
            return new ServiceResponse(
                true,
                'Shift group employees',
                200,
                $shiftGroup->getData()->employees
            );
        } else {
            return $shiftGroup;
        }
    }

    /**
     * @param int $shiftGroupId
     * @param array $employeeIds
     *
     * @return ServiceResponse
     */
    public function setShiftGroupEmployees(
        int   $shiftGroupId,
        array $employeeIds
    ): ServiceResponse
    {
        $shiftGroup = $this->getById($shiftGroupId);
        if ($shiftGroup->isSuccess()) {
            return new ServiceResponse(
                true,
                'Shift group employees synced',
                200,
                $shiftGroup->getData()->employees()->sync($employeeIds)
            );
        } else {
            return $shiftGroup;
        }
    }

    /**
     * @param int $companyId
     * @param int $order
     * @param string $name
     * @param string|null $description
     * @param int $addType
     * @param int $perDay
     * @param int $deleteIfExist
     * @param int $weekPermit
     * @param int|null $numberOfWeekPermitDay
     * @param int $setGroupWeekly
     * @param int $sundayEmployeeFromShiftGroup
     * @param int|null $sundayEmployeeFromShiftGroupId
     * @param int $day0
     * @param string $day0StartTime
     * @param string $day0EndTime
     * @param int $day1
     * @param string $day1StartTime
     * @param string $day1EndTime
     * @param int $day2
     * @param string $day2StartTime
     * @param string $day2EndTime
     * @param int $day3
     * @param string $day3StartTime
     * @param string $day3EndTime
     * @param int $day4
     * @param string $day4StartTime
     * @param string $day4EndTime
     * @param int $day5
     * @param string $day5StartTime
     * @param string $day5EndTime
     * @param int $day5
     * @param string $day6StartTime
     * @param string $day6EndTime
     * @param string $foodBreakStart ,
     * @param string $foodBreakEnd ,
     * @param int $getBreakWhileFoodTime
     * @param int $getFoodBreakWithoutFoodTime
     * @param int $singleBreakDuration
     * @param int $getFirstBreakAfterShiftStart
     * @param int $getLastBreakBeforeShiftEnd
     * @param int $getBreakAfterLastBreak
     * @param int $dailyFoodBreakAmount
     * @param int $dailyBreakDuration
     * @param int $dailyFoodBreakDuration
     * @param int $dailyBreakBreakDuration
     * @param int $momentaryFoodBreakDuration
     * @param int $momentaryBreakBreakDuration
     * @param int $fridayAdditionalBreakDuration
     * @param int $suspendBreakUsing
     *
     * @return ServiceResponse
     */
    public function create(
        int         $companyId,
        int         $order,
        string      $name,
        string|null $description,
        int         $addType,
        ?int        $perDay,
        int         $deleteIfExist,
        int         $weekPermit,
        int|null    $numberOfWeekPermitDay,
        int         $setGroupWeekly,
        int         $sundayEmployeeFromShiftGroup,
        int|null    $sundayEmployeeFromShiftGroupId,
        int         $day0,
        string      $day0StartTime,
        string      $day0EndTime,
        int         $day1,
        string      $day1StartTime,
        string      $day1EndTime,
        int         $day2,
        string      $day2StartTime,
        string      $day2EndTime,
        int         $day3,
        string      $day3StartTime,
        string      $day3EndTime,
        int         $day4,
        string      $day4StartTime,
        string      $day4EndTime,
        int         $day5,
        string      $day5StartTime,
        string      $day5EndTime,
        int         $day6,
        string      $day6StartTime,
        string      $day6EndTime,
        string      $foodBreakStart,
        string      $foodBreakEnd,
        int         $getBreakWhileFoodTime,
        int         $getFoodBreakWithoutFoodTime,
        int         $singleBreakDuration,
        int         $getFirstBreakAfterShiftStart,
        int         $getLastBreakBeforeShiftEnd,
        int         $getBreakAfterLastBreak,
        int         $dailyFoodBreakAmount,
        int         $dailyBreakDuration,
        int         $dailyFoodBreakDuration,
        int         $dailyBreakBreakDuration,
        int         $momentaryFoodBreakDuration,
        int         $momentaryBreakBreakDuration,
        int         $fridayAdditionalBreakDuration,
        int         $suspendBreakUsing
    ): ServiceResponse
    {
        $shiftGroup = new ShiftGroup;
        $shiftGroup->company_id = $companyId;
        $shiftGroup->order = $order;
        $shiftGroup->name = $name;
        $shiftGroup->description = $description;
        $shiftGroup->add_type = $addType;
        $shiftGroup->per_day = $perDay;
        $shiftGroup->delete_if_exist = $deleteIfExist;
        $shiftGroup->week_permit = $weekPermit;
        $shiftGroup->number_of_week_permit_day = $numberOfWeekPermitDay;
        $shiftGroup->set_group_weekly = $setGroupWeekly;
        $shiftGroup->sunday_employee_from_shift_group = $sundayEmployeeFromShiftGroup;
        $shiftGroup->sunday_employee_from_shift_group_id = $sundayEmployeeFromShiftGroupId;
        $shiftGroup->day0 = $day0;
        $shiftGroup->day0_start_time = $day0StartTime;
        $shiftGroup->day0_end_time = $day0EndTime;
        $shiftGroup->day1 = $day1;
        $shiftGroup->day1_start_time = $day1StartTime;
        $shiftGroup->day1_end_time = $day1EndTime;
        $shiftGroup->day2 = $day2;
        $shiftGroup->day2_start_time = $day2StartTime;
        $shiftGroup->day2_end_time = $day2EndTime;
        $shiftGroup->day3 = $day3;
        $shiftGroup->day3_start_time = $day3StartTime;
        $shiftGroup->day3_end_time = $day3EndTime;
        $shiftGroup->day4 = $day4;
        $shiftGroup->day4_start_time = $day4StartTime;
        $shiftGroup->day4_end_time = $day4EndTime;
        $shiftGroup->day5 = $day5;
        $shiftGroup->day5_start_time = $day5StartTime;
        $shiftGroup->day5_end_time = $day5EndTime;
        $shiftGroup->day6 = $day6;
        $shiftGroup->day6_start_time = $day6StartTime;
        $shiftGroup->day6_end_time = $day6EndTime;
        $shiftGroup->food_break_start = $foodBreakStart;
        $shiftGroup->food_break_end = $foodBreakEnd;
        $shiftGroup->get_break_while_food_time = $getBreakWhileFoodTime;
        $shiftGroup->get_food_break_without_food_time = $getFoodBreakWithoutFoodTime;
        $shiftGroup->single_break_duration = $singleBreakDuration;
        $shiftGroup->get_first_break_after_shift_start = $getFirstBreakAfterShiftStart;
        $shiftGroup->get_last_break_before_shift_end = $getLastBreakBeforeShiftEnd;
        $shiftGroup->get_break_after_last_break = $getBreakAfterLastBreak;
        $shiftGroup->daily_food_break_amount = $dailyFoodBreakAmount;
        $shiftGroup->daily_break_duration = $dailyBreakDuration;
        $shiftGroup->daily_food_break_duration = $dailyFoodBreakDuration;
        $shiftGroup->daily_break_break_duration = $dailyBreakBreakDuration;
        $shiftGroup->momentary_food_break_duration = $momentaryFoodBreakDuration;
        $shiftGroup->momentary_break_break_duration = $momentaryBreakBreakDuration;
        $shiftGroup->friday_additional_break_duration = $fridayAdditionalBreakDuration;
        $shiftGroup->suspend_break_using = $suspendBreakUsing;
        $shiftGroup->save();

        return new ServiceResponse(
            true,
            'Shift group created successfully.',
            201,
            $shiftGroup
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param int $order
     * @param string $name
     * @param string|null $description
     * @param int $addType
     * @param int $perDay
     * @param int $deleteIfExist
     * @param int $weekPermit
     * @param int|null $numberOfWeekPermitDay
     * @param int $setGroupWeekly
     * @param int $sundayEmployeeFromShiftGroup
     * @param int|null $sundayEmployeeFromShiftGroupId
     * @param int $day0
     * @param string $day0StartTime
     * @param string $day0EndTime
     * @param int $day1
     * @param string $day1StartTime
     * @param string $day1EndTime
     * @param int $day2
     * @param string $day2StartTime
     * @param string $day2EndTime
     * @param int $day3
     * @param string $day3StartTime
     * @param string $day3EndTime
     * @param int $day4
     * @param string $day4StartTime
     * @param string $day4EndTime
     * @param int $day5
     * @param string $day5StartTime
     * @param string $day5EndTime
     * @param int $day5
     * @param string $day6StartTime
     * @param string $day6EndTime
     * @param string $foodBreakStart ,
     * @param string $foodBreakEnd ,
     * @param int $getBreakWhileFoodTime
     * @param int $getFoodBreakWithoutFoodTime
     * @param int $singleBreakDuration
     * @param int $getFirstBreakAfterShiftStart
     * @param int $getLastBreakBeforeShiftEnd
     * @param int $getBreakAfterLastBreak
     * @param int $dailyFoodBreakAmount
     * @param int $dailyBreakDuration
     * @param int $dailyFoodBreakDuration
     * @param int $dailyBreakBreakDuration
     * @param int $momentaryFoodBreakDuration
     * @param int $momentaryBreakBreakDuration
     * @param int $fridayAdditionalBreakDuration
     * @param int $suspendBreakUsing
     *
     * @return ServiceResponse
     */
    public function update(
        int         $id,
        int         $companyId,
        int         $order,
        string      $name,
        string|null $description,
        int         $addType,
        ?int        $perDay,
        int         $deleteIfExist,
        int         $weekPermit,
        int|null    $numberOfWeekPermitDay,
        int         $setGroupWeekly,
        int         $sundayEmployeeFromShiftGroup,
        int|null    $sundayEmployeeFromShiftGroupId,
        int         $day0,
        string      $day0StartTime,
        string      $day0EndTime,
        int         $day1,
        string      $day1StartTime,
        string      $day1EndTime,
        int         $day2,
        string      $day2StartTime,
        string      $day2EndTime,
        int         $day3,
        string      $day3StartTime,
        string      $day3EndTime,
        int         $day4,
        string      $day4StartTime,
        string      $day4EndTime,
        int         $day5,
        string      $day5StartTime,
        string      $day5EndTime,
        int         $day6,
        string      $day6StartTime,
        string      $day6EndTime,
        string      $foodBreakStart,
        string      $foodBreakEnd,
        int         $getBreakWhileFoodTime,
        int         $getFoodBreakWithoutFoodTime,
        int         $singleBreakDuration,
        int         $getFirstBreakAfterShiftStart,
        int         $getLastBreakBeforeShiftEnd,
        int         $getBreakAfterLastBreak,
        int         $dailyFoodBreakAmount,
        int         $dailyBreakDuration,
        int         $dailyFoodBreakDuration,
        int         $dailyBreakBreakDuration,
        int         $momentaryFoodBreakDuration,
        int         $momentaryBreakBreakDuration,
        int         $fridayAdditionalBreakDuration,
        int         $suspendBreakUsing
    ): ServiceResponse
    {
        $shiftGroup = $this->getById($id);
        if ($shiftGroup->isSuccess()) {
            $shiftGroup->getData()->company_id = $companyId;
            $shiftGroup->getData()->order = $order;
            $shiftGroup->getData()->name = $name;
            $shiftGroup->getData()->description = $description;
            $shiftGroup->getData()->add_type = $addType;
            $shiftGroup->getData()->per_day = $perDay;
            $shiftGroup->getData()->delete_if_exist = $deleteIfExist;
            $shiftGroup->getData()->week_permit = $weekPermit;
            $shiftGroup->getData()->number_of_week_permit_day = $numberOfWeekPermitDay;
            $shiftGroup->getData()->set_group_weekly = $setGroupWeekly;
            $shiftGroup->getData()->sunday_employee_from_shift_group = $sundayEmployeeFromShiftGroup;
            $shiftGroup->getData()->sunday_employee_from_shift_group_id = $sundayEmployeeFromShiftGroupId;
            $shiftGroup->getData()->day0 = $day0;
            $shiftGroup->getData()->day0_start_time = $day0StartTime;
            $shiftGroup->getData()->day0_end_time = $day0EndTime;
            $shiftGroup->getData()->day1 = $day1;
            $shiftGroup->getData()->day1_start_time = $day1StartTime;
            $shiftGroup->getData()->day1_end_time = $day1EndTime;
            $shiftGroup->getData()->day2 = $day2;
            $shiftGroup->getData()->day2_start_time = $day2StartTime;
            $shiftGroup->getData()->day2_end_time = $day2EndTime;
            $shiftGroup->getData()->day3 = $day3;
            $shiftGroup->getData()->day3_start_time = $day3StartTime;
            $shiftGroup->getData()->day3_end_time = $day3EndTime;
            $shiftGroup->getData()->day4 = $day4;
            $shiftGroup->getData()->day4_start_time = $day4StartTime;
            $shiftGroup->getData()->day4_end_time = $day4EndTime;
            $shiftGroup->getData()->day5 = $day5;
            $shiftGroup->getData()->day5_start_time = $day5StartTime;
            $shiftGroup->getData()->day5_end_time = $day5EndTime;
            $shiftGroup->getData()->day6 = $day6;
            $shiftGroup->getData()->day6_start_time = $day6StartTime;
            $shiftGroup->getData()->day6_end_time = $day6EndTime;
            $shiftGroup->getData()->food_break_start = $foodBreakStart;
            $shiftGroup->getData()->food_break_end = $foodBreakEnd;
            $shiftGroup->getData()->get_break_while_food_time = $getBreakWhileFoodTime;
            $shiftGroup->getData()->get_food_break_without_food_time = $getFoodBreakWithoutFoodTime;
            $shiftGroup->getData()->single_break_duration = $singleBreakDuration;
            $shiftGroup->getData()->get_first_break_after_shift_start = $getFirstBreakAfterShiftStart;
            $shiftGroup->getData()->get_last_break_before_shift_end = $getLastBreakBeforeShiftEnd;
            $shiftGroup->getData()->get_break_after_last_break = $getBreakAfterLastBreak;
            $shiftGroup->getData()->daily_food_break_amount = $dailyFoodBreakAmount;
            $shiftGroup->getData()->daily_break_duration = $dailyBreakDuration;
            $shiftGroup->getData()->daily_food_break_duration = $dailyFoodBreakDuration;
            $shiftGroup->getData()->daily_break_break_duration = $dailyBreakBreakDuration;
            $shiftGroup->getData()->momentary_food_break_duration = $momentaryFoodBreakDuration;
            $shiftGroup->getData()->momentary_break_break_duration = $momentaryBreakBreakDuration;
            $shiftGroup->getData()->friday_additional_break_duration = $fridayAdditionalBreakDuration;
            $shiftGroup->getData()->suspend_break_using = $suspendBreakUsing;
            $shiftGroup->getData()->save();

            return new ServiceResponse(
                true,
                'Shift group updated successfully',
                200,
                $shiftGroup->getData()
            );
        } else {
            return $shiftGroup;
        }
    }
}
