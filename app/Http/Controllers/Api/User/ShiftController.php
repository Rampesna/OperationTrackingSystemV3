<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ShiftController\GetAllRequest;
use App\Http\Requests\Api\User\ShiftController\GetByIdRequest;
use App\Http\Requests\Api\User\ShiftController\GetByCompanyIdRequest;
use App\Http\Requests\Api\User\ShiftController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\ShiftController\RobotRequest;
use App\Http\Requests\Api\User\ShiftController\DeleteByIdsRequest;
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
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->shiftService->getAll();
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
        $getByIdResponse = $this->shiftService->getById(
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
     * @param GetByCompanyIdRequest $request
     */
    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        $getByCompanyIdResponse = $this->shiftService->getByCompanyId(
            $request->companyId,
            $request->startDate,
            $request->endDate,
            $request->keyword,
            $request->jobDepartmentIds
        );
        if ($getByCompanyIdResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdResponse->getMessage(),
                $getByCompanyIdResponse->getData(),
                $getByCompanyIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdResponse->getMessage(),
                $getByCompanyIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $getByCompanyIdsResponse = $this->shiftService->getByCompanyIds(
            $request->companyIds,
            $request->startDate,
            $request->endDate,
            $request->keyword,
            $request->jobDepartmentIds,
            $request->shiftGroupIds
        );
        if ($getByCompanyIdsResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getData(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param RobotRequest $request
     */
    public function robot(RobotRequest $request)
    {
        set_time_limit(86400);
        $robotResponse = $this->shiftService->robot(
            $request->companyId,
            $request->month,
            $request->user()->id
        );
        if ($robotResponse->isSuccess()) {
            return $this->success(
                $robotResponse->getMessage(),
                $robotResponse->getData(),
                $robotResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $robotResponse->getMessage(),
                $robotResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteByIdsRequest $request
     */
    public function deleteByIds(DeleteByIdsRequest $request)
    {
        $deleteByIdsResponse = $this->shiftService->deleteByIds(
            $request->shiftIds
        );
        if ($deleteByIdsResponse->isSuccess()) {
            return $this->success(
                $deleteByIdsResponse->getMessage(),
                $deleteByIdsResponse->getData(),
                $deleteByIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteByIdsResponse->getMessage(),
                $deleteByIdsResponse->getStatusCode()
            );
        }
    }
}
