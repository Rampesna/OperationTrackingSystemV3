<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\JobDepartmentTypeController\GetByCompanyIdsRequest;
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
        return $this->success('Job department types', $this->jobDepartmentTypeService->getByCompanyIds(
            $request->companyIds
        ));
    }
}
