<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ShiftGroupController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\ShiftGroupController\GetByIdRequest;
use App\Http\Requests\Api\User\ShiftGroupController\CreateRequest;
use App\Http\Requests\Api\User\ShiftGroupController\UpdateRequest;
use App\Http\Requests\Api\User\ShiftGroupController\DeleteRequest;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Traits\Response;

class ShiftGroupController extends Controller
{
    use Response;

    /**
     * @var $shiftGroupService
     */
    private $shiftGroupService;

    /**
     * @param IShiftGroupService $shiftGroupService
     */
    public function __construct(IShiftGroupService $shiftGroupService)
    {
        $this->shiftGroupService = $shiftGroupService;
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        $getByCompanyIdsResponse = $this->shiftGroupService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($getByCompanyIdsResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getData(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->shiftGroupService->getById($request->id);
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (!in_array($request->companyId, $companyIds)) {
            return $this->error('Unauthorized', 401);
        }

        $createResponse = $this->shiftGroupService->create(
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
        );
        if ($createResponse->isSuccess()) {
            return $this->success(
                $createResponse->getMessage(),
                $createResponse->getData(),
                $createResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (!in_array($request->companyId, $companyIds)) {
            return $this->error('Unauthorized', 401);
        }

        $updateResponse = $this->shiftGroupService->update(
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
        );
        if ($updateResponse->isSuccess()) {
            return $this->success(
                $updateResponse->getMessage(),
                $updateResponse->getData(),
                $updateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $setShiftGroupEmployeesResponse = $this->shiftGroupService->setShiftGroupEmployees($request->id, []);
        if ($setShiftGroupEmployeesResponse->isSuccess()) {
            $deleteResponse = $this->shiftGroupService->delete($request->id);
            if ($deleteResponse->isSuccess()) {
                return $this->success(
                    $deleteResponse->getMessage(),
                    $deleteResponse->getData(),
                    $deleteResponse->getStatusCode()
                );
            } else {
                return $this->error(
                    $deleteResponse->getMessage(),
                    $deleteResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $setShiftGroupEmployeesResponse->getMessage(),
                $setShiftGroupEmployeesResponse->getStatusCode()
            );
        }
    }
}
