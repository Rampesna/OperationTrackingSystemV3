<?php

namespace App\Http\Requests\Api\User\ShiftGroupController;

use App\Http\Requests\Api\BaseApiRequest;

class CreateRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'companyId' => 'required',
            'order' => 'required',
            'name' => 'required',
            'addType' => 'required',
//            'perDay' => 'required',
            'day1' => 'required',
            'day1StartTime' => 'required',
            'day1EndTime' => 'required',
            'day2' => 'required',
            'day2StartTime' => 'required',
            'day2EndTime' => 'required',
            'day3' => 'required',
            'day3StartTime' => 'required',
            'day3EndTime' => 'required',
            'day4' => 'required',
            'day4StartTime' => 'required',
            'day4EndTime' => 'required',
            'day5' => 'required',
            'day5StartTime' => 'required',
            'day5EndTime' => 'required',
            'day6' => 'required',
            'day6StartTime' => 'required',
            'day6EndTime' => 'required',
            'day0' => 'required',
            'day0StartTime' => 'required',
            'day0EndTime' => 'required',
            'foodBreakStart' => 'required',
            'foodBreakEnd' => 'required',
            'getBreakWhileFoodTime' => 'required',
            'getFoodBreakWithoutFoodTime' => 'required',
            'singleBreakDuration' => 'required',
            'getFirstBreakAfterShiftStart' => 'required',
            'getLastBreakBeforeShiftEnd' => 'required',
            'getBreakAfterLastBreak' => 'required',
            'dailyFoodBreakAmount' => 'required',
            'dailyBreakDuration' => 'required',
            'dailyFoodBreakDuration' => 'required',
            'dailyBreakBreakDuration' => 'required',
            'momentaryFoodBreakDuration' => 'required',
            'momentaryBreakBreakDuration' => 'required',
            'fridayAdditionalBreakDuration' => 'required',
            'suspendBreakUsing' => 'required',
            'deleteIfExist' => 'required',
            'weekPermit' => 'required',
            'numberOfWeekPermitDay' => 'nullable',
            'setGroupWeekly' => 'required',
            'sundayEmployeeFromShiftGroup' => 'required',
            'sundayEmployeeFromShiftGroupId' => 'nullable',
        ];
    }
}
