<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\OvertimeController\GetDateBetweenRequest;
use App\Http\Requests\Api\Employee\OvertimeController\GetByIdRequest;
use App\Http\Requests\Api\Employee\OvertimeController\CreateRequest;
use App\Interfaces\Eloquent\IOvertimeService;
use App\Traits\Response;

class OvertimeController extends Controller
{
    use Response;

    private $overtimeService;

    public function __construct(IOvertimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }

    public function getDateBetween(GetDateBetweenRequest $request)
    {
        return $this->success('Employee overtimes', $this->overtimeService->getDateBetween(
            $request->user()->id,
            $request->startDate,
            $request->endDate
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        $overtime = $this->overtimeService->getById(
            $request->id
        );

        if (!$overtime || $overtime->employee_id != $request->user()->id) {
            return $this->error('Overtime not found', 404);
        }

        return $this->success('Employee overtime', $overtime);
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Overtime created', $this->overtimeService->create(
            $request->user()->id,
            $request->typeId,
            1,
            $request->startDate,
            $request->endDate,
            $request->description
        ));
    }

    public function update(CreateRequest $request)
    {
        $overtime = $this->overtimeService->getById(
            $request->id
        );

        if (!$overtime || $overtime->employee_id != $request->user()->id) {
            return $this->error('Overtime not found', 404);
        }

        if ($overtime->status_id != 1) {
            return $this->error('You can not update overtime with status other than pending', 403);
        }

        return $this->success('Overtime updated', $this->overtimeService->update(
            $request->id,
            $request->user()->id,
            $request->typeId,
            1,
            $request->startDate,
            $request->endDate,
            $request->description
        ));
    }
}
