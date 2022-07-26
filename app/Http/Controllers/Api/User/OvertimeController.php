<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OvertimeController\GetAllRequest;
use App\Http\Requests\Api\User\OvertimeController\GetByIdRequest;
use App\Http\Requests\Api\User\OvertimeController\GetByStatusIdAndCompanyIdsRequest;
use App\Http\Requests\Api\User\OvertimeController\GetByDateAndCompanyIdsRequest;
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
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->overtimeService->getAll();
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
        $getByIdResponse = $this->overtimeService->getById($request->id);
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
     * @param GetByStatusIdAndCompanyIdsRequest $request
     */
    public function getByStatusIdAndCompanyIds(GetByStatusIdAndCompanyIdsRequest $request)
    {
        $getByStatusIdResponse = $this->overtimeService->getByStatusIdAndCompanyIds(
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
        $getByDateResponse = $this->overtimeService->getByDateAndCompanyIds(
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
}
