<?php

namespace App\Interfaces\Eloquent;

interface IShiftGroupService extends IEloquentService
{
    /**
     * @param int $companyId
     */
    public function getByCompanyId(
        int $companyId
    );

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function getByCompanyIds(
        array       $companyIds,
        int         $pageIndex = 0,
        int         $pageSize = 10,
        string|null $keyword = null
    );

    /**
     * @param int $shiftGroupId
     */
    public function getShiftGroupEmployees(
        int $shiftGroupId
    );

    /**
     * @param int $shiftGroupId
     * @param array $employeeIds
     */
    public function setShiftGroupEmployees(
        int   $shiftGroupId,
        array $employeeIds
    );

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
     */
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
    );

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
     */
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
    );
}
