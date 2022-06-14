<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IJobDepartmentService;
use App\Interfaces\OperationApi\ITvScreenService;
use App\Http\Requests\Api\User\OperationApi\TvScreenController\GetStaffStatusListRequest;
use App\Http\Requests\Api\User\OperationApi\TvScreenController\GetStaffStatusUserListRequest;
use App\Traits\Response;

class TvScreenController extends Controller
{
    use Response;

    private $tvScreenService;

    private $jobDepartmentService;

    public function __construct(ITvScreenService $tvScreenService, IJobDepartmentService $jobDepartmentService)
    {
        $this->tvScreenService = $tvScreenService;
        $this->jobDepartmentService = $jobDepartmentService;
    }

    public function getJobList()
    {
        return $this->success('Job list', $this->tvScreenService->GetJobList());
    }

    public function getStaffStatusList(GetStaffStatusListRequest $request)
    {
        return $this->success('Staff status list', $this->tvScreenService->GetStaffStatusList(
            $request->companyIds
        ));
    }

    public function getStaffStatusUserList(GetStaffStatusUserListRequest $request)
    {
//        $jobDepartments = $this->jobDepartmentService->getByTypeIds($request->employeeGuids);
//        $employeeGuids = [];
//
//        foreach ($jobDepartments as $jobDepartment) {
//            foreach ($jobDepartment->employees as $employee) {
//                $employeeGuids[] = intval($employee->guid);
//            }
//        }

        return $this->success('Staff status user list', $this->tvScreenService->GetStaffStatusUserList(
            $request->employeeGuids
        ));
    }
}
