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

    private $jobDepartmentService;

    public function __construct(IJobDepartmentService $jobDepartmentService)
    {
        $this->jobDepartmentService = $jobDepartmentService;
    }

    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        return $this->success('Job departments', $this->jobDepartmentService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Job department', $this->jobDepartmentService->getById(
            $request->id
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Job department created', $this->jobDepartmentService->create(
            $request->companyId,
            $request->name,
            $request->typeId
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('Job department updated', $this->jobDepartmentService->update(
            $request->id,
            $request->companyId,
            $request->name,
            $request->typeId
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('Job department deleted', $this->jobDepartmentService->delete(
            $request->id
        ));
    }
}
