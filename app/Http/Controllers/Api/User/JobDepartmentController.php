<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\JobDepartmentController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\JobDepartmentController\GetByIdRequest;
use App\Http\Requests\Api\User\JobDepartmentController\CreateRequest;
use App\Http\Requests\Api\User\JobDepartmentController\UpdateRequest;
use App\Http\Requests\Api\User\JobDepartmentController\DeleteRequest;
use App\Interfaces\Eloquent\IJobDepartmentService;
use App\Traits\Response;

class JobDepartmentController extends Controller
{
    use Response;

    /**
     * @var $jobDepartmentService
     */
    private $jobDepartmentService;

    /**
     * @param IJobDepartmentService $jobDepartmentService
     */
    public function __construct(IJobDepartmentService $jobDepartmentService)
    {
        $this->jobDepartmentService = $jobDepartmentService;
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

        $getByCompanyIdsResponse = $this->jobDepartmentService->getByCompanyIds(
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
        $getByIdResponse = $this->jobDepartmentService->getById(
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
        $createResponse = $this->jobDepartmentService->create(
            $request->companyId,
            $request->name,
            $request->typeId
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
        $updateResponse = $this->jobDepartmentService->update(
            $request->id,
            $request->companyId,
            $request->name,
            $request->typeId
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
        $deleteResponse = $this->jobDepartmentService->delete(
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
