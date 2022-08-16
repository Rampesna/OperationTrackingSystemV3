<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PermitController\GetAllRequest;
use App\Http\Requests\Api\User\PermitController\GetByIdRequest;
use App\Http\Requests\Api\User\PermitController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\PermitController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\User\PermitController\GetDateBetweenByEmployeeIdsAndTypeIdsRequest;
use App\Http\Requests\Api\User\PermitController\GetDateBetweenAndCompanyIdsRequest;
use App\Http\Requests\Api\User\PermitController\GetByStatusIdAndCompanyIdsRequest;
use App\Http\Requests\Api\User\PermitController\GetByDateAndCompanyIdsRequest;
use App\Http\Requests\Api\User\PermitController\CalculateAnnualPermitRequest;
use App\Http\Requests\Api\User\PermitController\CreateRequest;
use App\Http\Requests\Api\User\PermitController\UpdateRequest;
use App\Http\Requests\Api\User\PermitController\SetStatusRequest;
use App\Http\Requests\Api\User\PermitController\DeleteRequest;
use App\Interfaces\Eloquent\IPermitService;
use App\Traits\Response;

class PermitController extends Controller
{
    use Response;

    /**
     * @var $permitService
     */
    private $permitService;

    /**
     * @param IPermitService $permitService
     */
    public function __construct(IPermitService $permitService)
    {
        $this->permitService = $permitService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->permitService->getAll();
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
        $getByIdResponse = $this->permitService->getById($request->id);
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
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $getByCompanyIdsResponse = $this->permitService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword,
            $request->startDate,
            $request->endDate,
            $request->statusId,
            $request->typeId
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
     * @param GetDateBetweenAndCompanyIdsRequest $request
     */
    public function getDateBetweenAndCompanyIds(GetDateBetweenAndCompanyIdsRequest $request)
    {
        $getDateBetweenAndCompanyIdsResponse = $this->permitService->getDateBetweenAndCompanyIds(
            $request->companyIds,
            $request->startDate,
            $request->endDate
        );
        if ($getDateBetweenAndCompanyIdsResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenAndCompanyIdsResponse->getMessage(),
                $getDateBetweenAndCompanyIdsResponse->getData(),
                $getDateBetweenAndCompanyIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenAndCompanyIdsResponse->getMessage(),
                $getDateBetweenAndCompanyIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $getByEmployeeIdResponse = $this->permitService->getByEmployeeId(
            $request->employeeId,
            $request->pageIndex,
            $request->pageSize,
            $request->startDate,
            $request->endDate,
            $request->statusId,
            $request->typeId
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
     * @param GetDateBetweenByEmployeeIdsAndTypeIdsRequest $request
     */
    public function getDateBetweenByEmployeeIdsAndTypeIds(GetDateBetweenByEmployeeIdsAndTypeIdsRequest $request)
    {
        $getDateBetweenByEmployeeIdsAndTypeIdsResponse = $this->permitService->getDateBetweenByEmployeeIdsAndTypeIds(
            $request->employeeIds,
            $request->typeIds,
            $request->startDate,
            $request->endDate,
        );
        if ($getDateBetweenByEmployeeIdsAndTypeIdsResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenByEmployeeIdsAndTypeIdsResponse->getMessage(),
                $getDateBetweenByEmployeeIdsAndTypeIdsResponse->getData(),
                $getDateBetweenByEmployeeIdsAndTypeIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenByEmployeeIdsAndTypeIdsResponse->getMessage(),
                $getDateBetweenByEmployeeIdsAndTypeIdsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByStatusIdAndCompanyIdsRequest $request
     */
    public function getByStatusIdAndCompanyIds(GetByStatusIdAndCompanyIdsRequest $request)
    {
        $getByStatusIdResponse = $this->permitService->getByStatusIdAndCompanyIds(
            $request->statusId,
            $request->companyIds
        );
        if ($getByStatusIdResponse->isSuccess()) {
            return $this->success(
                $getByStatusIdResponse->getMessage(),
                $getByStatusIdResponse->getData(),
                $getByStatusIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByStatusIdResponse->getMessage(),
                $getByStatusIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByDateAndCompanyIdsRequest $request
     */
    public function getByDateAndCompanyIds(GetByDateAndCompanyIdsRequest $request)
    {
        $getByDateResponse = $this->permitService->getByDateAndCompanyIds(
            $request->date,
            $request->companyIds
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
     * @param CalculateAnnualPermitRequest $request
     */
    public function calculateAnnualPermit(CalculateAnnualPermitRequest $request)
    {
        $calculateAnnualPermitResponse = $this->permitService->calculateAnnualPermit(
            $request->employeeIds,
            $request->permitTypeIds
        );
        if ($calculateAnnualPermitResponse->isSuccess()) {
            return $this->success(
                $calculateAnnualPermitResponse->getMessage(),
                $calculateAnnualPermitResponse->getData(),
                $calculateAnnualPermitResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $calculateAnnualPermitResponse->getMessage(),
                $calculateAnnualPermitResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->permitService->create(
            $request->employeeId,
            $request->typeId,
            $request->statusId,
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
        $updateResponse = $this->permitService->update(
            $request->id,
            $request->employeeId,
            $request->typeId,
            $request->statusId,
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
    }

    /**
     * @param SetStatusRequest $request
     */
    public function setStatus(SetStatusRequest $request)
    {
        $setStatusResponse = $this->permitService->setStatus(
            $request->permitId,
            $request->statusId
        );
        if ($setStatusResponse->isSuccess()) {
            return $this->success(
                $setStatusResponse->getMessage(),
                $setStatusResponse->getData(),
                $setStatusResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setStatusResponse->getMessage(),
                $setStatusResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->permitService->delete($request->id);
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
