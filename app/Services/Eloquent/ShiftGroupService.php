<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IShiftGroupService;
use App\Models\Eloquent\ShiftGroup;

class ShiftGroupService implements IShiftGroupService
{
    public function getAll()
    {
        return ShiftGroup::all();
    }

    public function getById(
        int $id
    )
    {
        return ShiftGroup::with([
            'employees'
        ])->find(
            $id
        );
    }

    public function delete(
        int $id
    )
    {
        return ShiftGroup::destroy($id);
    }

    public function getByCompanyId(
        int         $companyId,
        int         $pageIndex = 0,
        int         $pageSize = 10,
        string|null $keyword = null
    )
    {
        $shiftGroups = ShiftGroup::where('company_id', $companyId);

        if ($keyword) {
            $shiftGroups->where('name', 'like', '%' . $keyword . '%');
        }

        return [
            'totalCount' => $shiftGroups->count(),
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize,
            'shiftGroups' => $shiftGroups->orderBy('order', 'asc')->skip($pageSize * $pageIndex)
                ->take($pageSize)
                ->get()
        ];
    }

    /**
     * @param int $shiftGroupId
     */
    public function getShiftGroupEmployees(
        int $shiftGroupId
    )
    {
        return $this->getById($shiftGroupId)->employees;
    }

    /**
     * @param int $shiftGroupId
     * @param array $employeeIds
     */
    public function setShiftGroupEmployees(
        int   $shiftGroupId,
        array $employeeIds
    )
    {
        $shiftGroup = $this->getById($shiftGroupId);
        $shiftGroup->employees()->sync($employeeIds);
    }

    public function create(
        int         $companyId,
        int         $order,
        string      $name,
        string|null $description,
        int         $addType,
        int         $perDay,
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
    )
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

        return $shiftGroup;
    }

    public function update(
        int         $id,
        int         $companyId,
        int         $order,
        string      $name,
        string|null $description,
        int         $addType,
        int         $perDay,
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
    )
    {
        $shiftGroup = ShiftGroup::find($id);
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

        return $shiftGroup;
    }
}
