<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\TvScreenController\GetJobListRequest;
use App\Interfaces\Eloquent\IJobDepartmentService;
use App\Interfaces\OperationApi\ITvScreenService;
use App\Http\Requests\Api\User\OperationApi\TvScreenController\GetStaffStatusListRequest;
use App\Http\Requests\Api\User\OperationApi\TvScreenController\GetStaffStatusUserListRequest;
use App\Traits\Response;

class TvScreenController extends Controller
{
    use Response;

    /**
     * @var $tvScreenService
     */
    private $tvScreenService;

    /**
     * @var $jobDepartmentService
     */
    private $jobDepartmentService;

    /**
     * @param ITvScreenService $tvScreenService
     * @param IJobDepartmentService $jobDepartmentService
     */
    public function __construct(
        ITvScreenService      $tvScreenService,
        IJobDepartmentService $jobDepartmentService
    )
    {
        $this->tvScreenService = $tvScreenService;
        $this->jobDepartmentService = $jobDepartmentService;
    }

    /**
     * @param GetJobListRequest $request
     */
    public function getJobList(GetJobListRequest $request)
    {
        $getJobListResponse = $this->tvScreenService->GetJobList();
        if ($getJobListResponse->isSuccess()) {
            return $this->success(
                $getJobListResponse->getMessage(),
                $getJobListResponse->getData(),
                $getJobListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getJobListResponse->getMessage(),
                $getJobListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetStaffStatusListRequest $request
     */
    public function getStaffStatusList(GetStaffStatusListRequest $request)
    {
        $getStaffStatusListResponse = $this->tvScreenService->GetStaffStatusList(
            $request->companyIds
        );
        if ($getStaffStatusListResponse->isSuccess()) {
            return $this->success(
                $getStaffStatusListResponse->getMessage(),
                $getStaffStatusListResponse->getData(),
                $getStaffStatusListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getStaffStatusListResponse->getMessage(),
                $getStaffStatusListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetStaffStatusUserListRequest $request
     */
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

        $getStaffStatusUserListResponse = $this->tvScreenService->GetStaffStatusUserList(
            $request->employeeGuids
        );
        if ($getStaffStatusUserListResponse->isSuccess()) {
            return $this->success(
                $getStaffStatusUserListResponse->getMessage(),
                $getStaffStatusUserListResponse->getData(),
                $getStaffStatusUserListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getStaffStatusUserListResponse->getMessage(),
                $getStaffStatusUserListResponse->getStatusCode()
            );
        }
    }
}
