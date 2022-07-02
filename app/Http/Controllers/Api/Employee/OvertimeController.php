<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\OvertimeController\GetDateBetweenRequest;
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
}
