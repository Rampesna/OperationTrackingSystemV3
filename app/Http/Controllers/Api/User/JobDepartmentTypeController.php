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

    private $jobDepartmentTypeService;

    public function __construct(IJobDepartmentTypeService $jobDepartmentTypeService)
    {
        $this->jobDepartmentTypeService = $jobDepartmentTypeService;
    }

    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $companyIds = $request->user()->companies->pluck('id')->toArray();

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companyIds)) {
                return $this->error('Unauthorized', 401);
            }
        }

        return $this->success('Job department types', $this->jobDepartmentTypeService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        ));
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Job department type', $this->jobDepartmentTypeService->getById(
            $request->id
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Job department type created', $this->jobDepartmentTypeService->create(
            $request->companyId,
            $request->name
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('Job department type updated', $this->jobDepartmentTypeService->update(
            $request->id,
            $request->companyId,
            $request->name
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('Job department type deleted', $this->jobDepartmentTypeService->delete(
            $request->id
        ));
    }
}
