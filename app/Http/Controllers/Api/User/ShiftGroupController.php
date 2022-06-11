<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ShiftGroupController\GetByCompanyIdRequest;
use App\Http\Requests\Api\User\ShiftGroupController\GetByIdRequest;
use App\Http\Requests\Api\User\ShiftGroupController\CreateRequest;
use App\Http\Requests\Api\User\ShiftGroupController\UpdateRequest;
use App\Http\Requests\Api\User\ShiftGroupController\DeleteRequest;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Traits\Response;

class ShiftGroupController extends Controller
{
    use Response;

    private $shiftGroupService;

    public function __construct(IShiftGroupService $shiftGroupService)
    {
        $this->shiftGroupService = $shiftGroupService;
    }

    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (!in_array($request->companyId, $companyIds)) {
            return $this->error('Unauthorized', 401);
        }

        return $this->success('Shift groups', $this->shiftGroupService->getByCompanyId(
            $request->companyId,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Shift group', $this->shiftGroupService->getById(
            $request->id
        ));
    }

    public function create(CreateRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (!in_array($request->companyId, $companyIds)) {
            return $this->error('Unauthorized', 401);
        }

        return $this->success('Shift group created', $this->shiftGroupService->create(
            $request->companyId,
            $request->order,
            $request->name,
            $request->description,
            $request->addType,
            $request->perDay,
            $request->deleteIfExist,
            $request->weekPermit,
            $request->numberOfWeekPermitDay,
            $request->setGroupWeekly,
            $request->sundayEmployeeFromShiftGroup,
            $request->sundayEmployeeFromShiftGroupId,
            $request->day0,
            $request->day0StartTime,
            $request->day0EndTime,
            $request->day1,
            $request->day1StartTime,
            $request->day1EndTime,
            $request->day2,
            $request->day2StartTime,
            $request->day2EndTime,
            $request->day3,
            $request->day3StartTime,
            $request->day3EndTime,
            $request->day4,
            $request->day4StartTime,
            $request->day4EndTime,
            $request->day5,
            $request->day5StartTime,
            $request->day5EndTime,
            $request->day6,
            $request->day6StartTime,
            $request->day6EndTime,
            $request->foodBreakStart,
            $request->foodBreakEnd,
            $request->getBreakWhileFoodTime,
            $request->getFoodBreakWithoutFoodTime,
            $request->singleBreakDuration,
            $request->getFirstBreakAfterShiftStart,
            $request->getLastBreakBeforeShiftEnd,
            $request->getBreakAfterLastBreak,
            $request->dailyFoodBreakAmount,
            $request->dailyBreakDuration,
            $request->dailyFoodBreakDuration,
            $request->dailyBreakBreakDuration,
            $request->momentaryFoodBreakDuration,
            $request->momentaryBreakBreakDuration,
            $request->fridayAdditionalBreakDuration,
            $request->suspendBreakUsing
        ));
    }

    public function update(UpdateRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (!in_array($request->companyId, $companyIds)) {
            return $this->error('Unauthorized', 401);
        }

        return $this->success('Shift group updated', $this->shiftGroupService->update(
            $request->id,
            $request->companyId,
            $request->order,
            $request->name,
            $request->description,
            $request->addType,
            $request->perDay,
            $request->deleteIfExist,
            $request->weekPermit,
            $request->numberOfWeekPermitDay,
            $request->setGroupWeekly,
            $request->sundayEmployeeFromShiftGroup,
            $request->sundayEmployeeFromShiftGroupId,
            $request->day0,
            $request->day0StartTime,
            $request->day0EndTime,
            $request->day1,
            $request->day1StartTime,
            $request->day1EndTime,
            $request->day2,
            $request->day2StartTime,
            $request->day2EndTime,
            $request->day3,
            $request->day3StartTime,
            $request->day3EndTime,
            $request->day4,
            $request->day4StartTime,
            $request->day4EndTime,
            $request->day5,
            $request->day5StartTime,
            $request->day5EndTime,
            $request->day6,
            $request->day6StartTime,
            $request->day6EndTime,
            $request->foodBreakStart,
            $request->foodBreakEnd,
            $request->getBreakWhileFoodTime,
            $request->getFoodBreakWithoutFoodTime,
            $request->singleBreakDuration,
            $request->getFirstBreakAfterShiftStart,
            $request->getLastBreakBeforeShiftEnd,
            $request->getBreakAfterLastBreak,
            $request->dailyFoodBreakAmount,
            $request->dailyBreakDuration,
            $request->dailyFoodBreakDuration,
            $request->dailyBreakBreakDuration,
            $request->momentaryFoodBreakDuration,
            $request->momentaryBreakBreakDuration,
            $request->fridayAdditionalBreakDuration,
            $request->suspendBreakUsing
        ));
    }

    public function delete(DeleteRequest $request)
    {
        $this->shiftGroupService->setShiftGroupEmployees($request->id, []);
        return $this->success('Shift group deleted', $this->shiftGroupService->delete(
            $request->id
        ));
    }
}
