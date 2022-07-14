<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\JobDepartmentTypeController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\JobDepartmentTypeController\GetByIdRequest;
use App\Http\Requests\Api\User\JobDepartmentTypeController\CreateRequest;
use App\Http\Requests\Api\User\JobDepartmentTypeController\UpdateRequest;
use App\Http\Requests\Api\User\JobDepartmentTypeController\DeleteRequest;
use App\Interfaces\Eloquent\IJobDepartmentTypeService;
use App\Traits\Response;

class JobDepartmentTypeController extends Controller
{
    use Response;

    /**
     * @var $jobDepartmentTypeService
     */
    private $jobDepartmentTypeService;

    /**
     * @param IJobDepartmentTypeService $jobDepartmentTypeService
     */
    public function __construct(IJobDepartmentTypeService $jobDepartmentTypeService)
    {
        $this->jobDepartmentTypeService = $jobDepartmentTypeService;
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        $getByCompanyIdsResponse = $this->jobDepartmentTypeService->getByCompanyIds(
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
        $getByIdResponse = $this->jobDepartmentTypeService->getById(
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
        $createResponse = $this->jobDepartmentTypeService->create(
            $request->companyId,
            $request->name
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
        $updateResponse = $this->jobDepartmentTypeService->update(
            $request->id,
            $request->companyId,
            $request->name
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
        $deleteResponse = $this->jobDepartmentTypeService->delete(
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
