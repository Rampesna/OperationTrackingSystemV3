<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ShiftController\GetByCompanyIdRequest;
use App\Http\Requests\Api\User\ShiftController\GetByCompanyIdsRequest;
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

    public function getAll()
    {
        return $this->success('Shifts', $this->shiftService->getAll());
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
            $request->jobDepartmentIds
        ));
    }
}
