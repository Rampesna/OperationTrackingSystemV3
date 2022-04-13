<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\JobDepartmentController\GetByCompanyIdRequest;
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

    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        return $this->success('Job departments', $this->jobDepartmentService->getByCompanyId($request->companyId));
    }
}
