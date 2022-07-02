<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ShiftController\GetAllRequest;
use App\Http\Requests\Api\User\ShiftController\GetByIdRequest;
use App\Http\Requests\Api\User\ShiftController\GetByCompanyIdRequest;
use App\Http\Requests\Api\User\ShiftController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\ShiftController\RobotRequest;
use App\Http\Requests\Api\User\ShiftController\DeleteByIdsRequest;
use App\Interfaces\Eloquent\IShiftService;
use App\Traits\Response;

class ShiftController extends Controller
{
    use Response;

    private $shiftService;

    public function __construct(IShiftService $shiftService)
    {
        $this->shiftService = $shiftService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('Shifts', $this->shiftService->getAll());
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Shift', $this->shiftService->getById(
            $request->id
        ));
    }

    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        return $this->success('Shifts', $this->shiftService->getByCompanyId(
            $request->companyId,
            $request->startDate,
            $request->endDate,
            $request->keyword,
            $request->jobDepartmentIds
        ));
    }

    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        return $this->success('Shifts', $this->shiftService->getByCompanyIds(
            $request->companyIds,
            $request->startDate,
            $request->endDate,
            $request->keyword,
            $request->jobDepartmentIds,
            $request->shiftGroupIds
        ));
    }

    public function robot(RobotRequest $request)
    {
        set_time_limit(86400);
        return $this->success('Shifts', $this->shiftService->robot(
            $request->companyId,
            $request->month,
            $request->user()->id
        ));
    }

    public function deleteByIds(DeleteByIdsRequest $request)
    {
        return $this->success('Shifts deleted', $this->shiftService->deleteByIds(
            $request->shiftIds
        ));
    }
}
