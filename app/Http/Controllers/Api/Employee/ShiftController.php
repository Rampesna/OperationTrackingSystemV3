<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\ShiftController\GetDateBetweenByEmployeeIdRequest;
use App\Http\Requests\Api\Employee\ShiftController\GetByIdRequest;
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

    public function getDateBetweenByEmployeeId(GetDateBetweenByEmployeeIdRequest $request)
    {
        return $this->success('Employee shifts', $this->shiftService->getDateBetweenByEmployeeId(
            $request->user()->id,
            $request->startDate,
            $request->endDate
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        $shift = $this->shiftService->getById($request->id);

        if ($shift->employee_id != $request->user()->id) {
            return $this->error('Shift not found', 404);
        }

        return $this->success('Employee shifts', $shift);
    }
}
