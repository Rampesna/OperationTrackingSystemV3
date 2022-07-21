<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\SpecialReportController\CreateRequest;
use App\Http\Requests\Api\User\SpecialReportController\DeleteRequest;
use App\Http\Requests\Api\User\SpecialReportController\GetByIdRequest;
use App\Http\Requests\Api\User\SpecialReportController\UpdateRequest;
use App\Http\Requests\Api\User\SpecialReportController\GetByCompanyIdsRequest;
use App\Interfaces\Eloquent\ISpecialReportService;
use App\Traits\Response;

class SpecialReportController extends Controller
{
    use Response;

    /**
     * @var $specialReportService
     */
    private $specialReportService;

    /**
     * @param ISpecialReportService $specialReportService
     */
    public function __construct(ISpecialReportService $specialReportService)
    {
        $this->specialReportService = $specialReportService;
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $getByCompanyIdsResponse = $this->specialReportService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
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
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->specialReportService->getById($request->id);
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
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (!in_array($request->companyId, $companyIds)) {
            return $this->error('Unauthorized', 401);
        }

        $createResponse = $this->specialReportService->create(
            $request->companyId,
            $request->name,
            $request->input('query')
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
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        if (!in_array($request->companyId, $companyIds)) {
            return $this->error('Unauthorized', 401);
        }

        $updateResponse = $this->specialReportService->update(
            $request->id,
            $request->companyId,
            $request->name,
            $request->input('query')
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
        $deleteResponse = $this->specialReportService->delete($request->id);
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
