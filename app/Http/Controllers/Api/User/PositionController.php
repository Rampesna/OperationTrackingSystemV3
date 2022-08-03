<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PositionController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\User\PositionController\GetByIdRequest;
use App\Http\Requests\Api\User\PositionController\CreateRequest;
use App\Http\Requests\Api\User\PositionController\UpdateRequest;
use App\Http\Requests\Api\User\PositionController\DeleteRequest;
use App\Interfaces\Eloquent\IPositionService;
use App\Traits\Response;

class PositionController extends Controller
{
    use Response;

    /**
     * @var $positionService
     */
    private $positionService;

    /**
     * @param IPositionService $positionService
     */
    public function __construct(IPositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    /**
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $getByEmployeeIdResponse = $this->positionService->getByEmployeeId(
            $request->employeeId
        );
        if ($getByEmployeeIdResponse->isSuccess()) {
            return $this->success(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getData(),
                $getByEmployeeIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->positionService->getById(
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
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->positionService->create(
            $request->employeeId,
            $request->companyId,
            $request->branchId,
            $request->departmentId,
            $request->titleId,
            $request->startDate,
            $request->endDate,
            $request->leavingReasonId,
            $request->salary,
            $request->salaryPayType,
            $request->bounty,
            $request->roadToll
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
        $updateResponse = $this->positionService->update(
            $request->id,
            $request->companyId,
            $request->branchId,
            $request->departmentId,
            $request->titleId,
            $request->startDate,
            $request->endDate,
            $request->leavingReasonId,
            $request->salary,
            $request->salaryPayType,
            $request->bounty,
            $request->roadToll
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
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->positionService->delete(
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
}
