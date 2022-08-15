<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\ShiftController\GetDateBetweenByEmployeeIdRequest;
use App\Http\Requests\Api\Employee\ShiftController\GetByDateAndEmployeeIdRequest;
use App\Http\Requests\Api\Employee\ShiftController\GetByIdRequest;
use App\Interfaces\Eloquent\IShiftService;
use App\Traits\Response;

class ShiftController extends Controller
{
    use Response;

    /**
     * @var $shiftService
     */
    private $shiftService;

    /**
     * @param IShiftService $shiftService
     */
    public function __construct(IShiftService $shiftService)
    {
        $this->shiftService = $shiftService;
    }

    /**
     * @param GetDateBetweenByEmployeeIdRequest $request
     */
    public function getDateBetweenByEmployeeId(GetDateBetweenByEmployeeIdRequest $request)
    {
        $getDateBetweenByEmployeeIdResponse = $this->shiftService->getDateBetweenByEmployeeId(
            $request->user()->id,
            $request->startDate,
            $request->endDate
        );
        if ($getDateBetweenByEmployeeIdResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenByEmployeeIdResponse->getMessage(),
                $getDateBetweenByEmployeeIdResponse->getData(),
                $getDateBetweenByEmployeeIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenByEmployeeIdResponse->getMessage(),
                $getDateBetweenByEmployeeIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByDateAndEmployeeIdRequest $request
     */
    public function getByDateAndEmployeeId(GetByDateAndEmployeeIdRequest $request)
    {
        $getByDateResponse = $this->shiftService->getByDateAndEmployeeId(
            $request->user()->id,
            $request->date
        );
        if ($getByDateResponse->isSuccess()) {
            return $this->success(
                $getByDateResponse->getMessage(),
                $getByDateResponse->getData(),
                $getByDateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByDateResponse->getMessage(),
                $getByDateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $shift = $this->shiftService->getById($request->id);

        if ($shift->isSuccess()) {
            if (!$shift->getData() || $shift->getData()->employee_id != $request->user()->id) {
                return $this->error('Shift not found', 404);
            }

            return $this->success(
                $shift->getMessage(),
                $shift->getData(),
                $shift->getStatusCode()
            );
        } else {
            return $this->error(
                $shift->getMessage(),
                $shift->getStatusCode()
            );
        }
    }
}
