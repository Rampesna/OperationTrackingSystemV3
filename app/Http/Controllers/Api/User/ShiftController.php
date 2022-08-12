<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ShiftController\GetAllRequest;
use App\Http\Requests\Api\User\ShiftController\GetByIdRequest;
use App\Http\Requests\Api\User\ShiftController\GetByCompanyIdRequest;
use App\Http\Requests\Api\User\ShiftController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\User\ShiftController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\ShiftController\CreateBatchRequest;
use App\Http\Requests\Api\User\ShiftController\CreateEmployeeFirstShiftsRequest;
use App\Http\Requests\Api\User\ShiftController\UpdateRequest;
use App\Http\Requests\Api\User\ShiftController\UpdateBatchRequest;
use App\Http\Requests\Api\User\ShiftController\RobotRequest;
use App\Http\Requests\Api\User\ShiftController\DeleteRequest;
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
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $getByCompanyIdsResponse = $this->shiftService->getByEmployeeId(
            $request->employeeId,
            $request->startDate,
            $request->endDate
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
     * @param CreateBatchRequest $request
     */
    public function createBatch(CreateBatchRequest $request)
    {
        $createBatchResponse = $this->shiftService->createBatch(
            $request->shifts,
            $request->user()->id
        );
        if ($createBatchResponse->isSuccess()) {
            return $this->success(
                $createBatchResponse->getMessage(),
                $createBatchResponse->getData(),
                $createBatchResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createBatchResponse->getMessage(),
                $createBatchResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateEmployeeFirstShiftsRequest $request
     */
    public function createEmployeeFirstShifts(CreateEmployeeFirstShiftsRequest $request)
    {
        $createBatchResponse = $this->shiftService->createEmployeeFirstShifts(
            $request->user()->id,
            $request->employeeId,
            $request->shiftGroupId,
            $request->month
        );
        if ($createBatchResponse->isSuccess()) {
            return $this->success(
                $createBatchResponse->getMessage(),
                $createBatchResponse->getData(),
                $createBatchResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createBatchResponse->getMessage(),
                $createBatchResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->shiftService->update(
            $request->id,
            $request->shiftGroupId,
            $request->startDate,
            $request->endDate
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
    }

    /**
     * @param UpdateBatchRequest $request
     */
    public function updateBatch(UpdateBatchRequest $request)
    {
        $updateBatchResponse = $this->shiftService->updateBatch(
            $request->employeeIds,
            $request->user()->id,
            $request->date,
            $request->startTime,
            $request->endTime
        );
        if ($updateBatchResponse->isSuccess()) {
            return $this->success(
                $updateBatchResponse->getMessage(),
                $updateBatchResponse->getData(),
                $updateBatchResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateBatchResponse->getMessage(),
                $updateBatchResponse->getStatusCode()
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
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->shiftService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
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
