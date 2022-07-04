<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\PermitController\GetDateBetweenRequest;
use App\Http\Requests\Api\Employee\PermitController\GetByIdRequest;
use App\Http\Requests\Api\Employee\PermitController\CreateRequest;
use App\Http\Requests\Api\Employee\PermitController\UpdateRequest;
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

    public function getById(GetByIdRequest $request)
    {
        $permit = $this->permitService->getById(
            $request->id
        );

        if (!$permit || $permit->employee_id != $request->user()->id) {
            return $this->error('Permit not found', 404);
        }

        return $this->success('Employee permit', $permit);
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

    public function update(UpdateRequest $request)
    {
        $permit = $this->permitService->getById(
            $request->id
        );

        if (!$permit || $permit->employee_id != $request->user()->id) {
            return $this->error('Permit not found', 404);
        }

        if ($permit->status_id != 1) {
            return $this->error('You can not update permit with status other than pending', 403);
        }

        return $this->success('Permit updated', $this->permitService->update(
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
