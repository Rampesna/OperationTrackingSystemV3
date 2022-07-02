<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\ShiftController\GetDateBetweenByEmployeeIdRequest;
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
}
