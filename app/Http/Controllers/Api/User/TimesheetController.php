<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\TimesheetController\GetAllRequest;
use App\Http\Requests\Api\User\TimesheetController\GetByIdRequest;
use App\Http\Requests\Api\User\TimesheetController\GetActiveTimesheetsRequest;
use App\Http\Requests\Api\User\TimesheetController\GetDateBetweenRequest;
use App\Http\Requests\Api\User\TimesheetController\CreateRequest;
use App\Http\Requests\Api\User\TimesheetController\SetEndTimeRequest;
use App\Interfaces\Eloquent\ITimesheetService;
use App\Traits\Response;

class TimesheetController extends Controller
{
    use Response;

    /**
     * @var $timesheetService
     */
    private $timesheetService;

    /**
     * @param ITimesheetService $timesheetService
     */
    public function __construct(ITimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->timesheetService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->timesheetService->getById(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetActiveTimesheetsRequest $request
     */
    public function getActiveTimesheets(GetActiveTimesheetsRequest $request)
    {
        $getActiveTimesheetsResponse = $this->timesheetService->getActiveTimesheets();
        if ($getActiveTimesheetsResponse->isSuccess()) {
            return $this->success(
                $getActiveTimesheetsResponse->getMessage(),
                $getActiveTimesheetsResponse->getData(),
                $getActiveTimesheetsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getActiveTimesheetsResponse->getMessage(),
                $getActiveTimesheetsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetDateBetweenRequest $request
     */
    public function getDateBetween(GetDateBetweenRequest $request)
    {
        $getActiveTimesheetsResponse = $this->timesheetService->getDateBetween(
            $request->startDate,
            $request->endDate
        );
        if ($getActiveTimesheetsResponse->isSuccess()) {
            return $this->success(
                $getActiveTimesheetsResponse->getMessage(),
                $getActiveTimesheetsResponse->getData(),
                $getActiveTimesheetsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getActiveTimesheetsResponse->getMessage(),
                $getActiveTimesheetsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->timesheetService->create(
            $request->taskId,
            $request->user()->id,
            date('Y-m-d H:i:s')
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
     * @param SetEndTimeRequest $request
     */
    public function setEndTime(SetEndTimeRequest $request)
    {
        $setEndTimeResponse = $this->timesheetService->setEndTime(
            $request->id,
            date('Y-m-d H:i:s'),
            $request->description
        );
        if ($setEndTimeResponse->isSuccess()) {
            return $this->success(
                $setEndTimeResponse->getMessage(),
                $setEndTimeResponse->getData(),
                $setEndTimeResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setEndTimeResponse->getMessage(),
                $setEndTimeResponse->getStatusCode()
            );
        }
    }
}
