<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\PermitController\GetDateBetweenRequest;
use App\Http\Requests\Api\Employee\PermitController\CreateRequest;
use App\Interfaces\Eloquent\IPermitService;
use App\Traits\Response;

class PermitController extends Controller
{
    use Response;

    private $permitService;

    public function __construct(IPermitService $permitService)
    {
        $this->permitService = $permitService;
    }

    public function getDateBetween(GetDateBetweenRequest $request)
    {
        return $this->success('Employee permits', $this->permitService->getDateBetween(
            $request->user()->id,
            $request->startDate,
            $request->endDate
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Permit created', $this->permitService->create(
            $request->user()->id,
            $request->typeId,
            1,
            $request->startDate,
            $request->endDate,
            $request->description
        ));
    }
}
