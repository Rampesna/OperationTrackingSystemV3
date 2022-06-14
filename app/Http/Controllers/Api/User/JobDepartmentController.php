<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\JobDepartmentController\GetByCompanyIdsRequest;
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

        return $this->success('Job departments', $this->jobDepartmentService->getByCompanyIds($request->companyIds));
    }
}
