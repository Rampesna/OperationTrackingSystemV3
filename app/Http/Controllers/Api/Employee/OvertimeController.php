<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\OvertimeController\GetDateBetweenRequest;
use App\Http\Requests\Api\Employee\OvertimeController\GetByIdRequest;
use App\Http\Requests\Api\Employee\OvertimeController\CreateRequest;
use App\Http\Requests\Api\Employee\OvertimeController\UpdateRequest;
use App\Interfaces\Eloquent\IOvertimeService;
use App\Traits\Response;

class OvertimeController extends Controller
{
    use Response;

    /**
     * @var $overtimeService
     */
    private $overtimeService;

    /**
     * @param IOvertimeService $overtimeService
     */
    public function __construct(IOvertimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }

    /**
     * @param GetDateBetweenRequest $request
     */
    public function getDateBetween(GetDateBetweenRequest $request)
    {
        $overtimes = $this->overtimeService->getDateBetween(
            $request->user()->id,
            $request->startDate,
            $request->endDate
        );
        if ($overtimes->isSuccess()) {
            return $this->success(
                $overtimes->getMessage(),
                $overtimes->getData(),
                $overtimes->getStatusCode()
            );
        } else {
            return $this->error(
                $overtimes->getMessage(),
                $overtimes->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $overtime = $this->overtimeService->getById(
            $request->id
        );
        if ($overtime->isSuccess()) {
            if (!$overtime->getData() || $overtime->getData()->employee_id != $request->user()->id) {
                return $this->error('Overtime not found', 404);
            }
            return $this->success(
                $overtime->getMessage(),
                $overtime->getData(),
                $overtime->getStatusCode()
            );
        } else {
            return $this->error(
                $overtime->getMessage(),
                $overtime->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->overtimeService->create(
            $request->user()->id,
            $request->typeId,
            1,
            $request->startDate,
            $request->endDate,
            $request->description
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
        $overtime = $this->overtimeService->getById(
            $request->id
        );
        if ($overtime->isSuccess()) {
            if (!$overtime->getData() || $overtime->getData()->employee_id != $request->user()->id) {
                return $this->error('Overtime not found', 404);
            }

            if ($overtime->getData()->status_id != 1) {
                return $this->error('You can not update overtime with status other than pending', 403);
            }

            $updateResponse = $this->overtimeService->update(
                $request->id,
                $request->user()->id,
                $request->typeId,
                1,
                $request->startDate,
                $request->endDate,
                $request->description
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
        } else {
            return $this->error(
                $overtime->getMessage(),
                $overtime->getStatusCode()
            );
        }
    }
}
