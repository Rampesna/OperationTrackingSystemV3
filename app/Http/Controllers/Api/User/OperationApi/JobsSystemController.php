<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\JobsSystemController\SetJobsExcelRequest;
use App\Http\Requests\Api\User\OperationApi\JobsSystemController\SetJobsWithIdRequest;
use App\Http\Requests\Api\User\OperationApi\JobsSystemController\SetJobsClosedExcelRequest;
use App\Http\Requests\Api\User\OperationApi\JobsSystemController\SetJobSuspendRequest;
use App\Http\Requests\Api\User\OperationApi\JobsSystemController\SetJobCaseWorkDeleteRequest;
use App\Interfaces\OperationApi\IJobsSystemService;
use App\Traits\Response;
use Maatwebsite\Excel\Facades\Excel;

class JobsSystemController extends Controller
{
    use Response;

    /**
     * @var $jobsSystemService
     */
    private $jobsSystemService;

    /**
     * @param IJobsSystemService $jobsSystemService
     */
    public function __construct(IJobsSystemService $jobsSystemService)
    {
        $this->jobsSystemService = $jobsSystemService;
    }

    /**
     * @param SetJobsExcelRequest $request
     */
    public function setJobsExcel(SetJobsExcelRequest $request)
    {
        $file = $request->file('file');

        $jobList = [];
        $jobs = Excel::toCollection(null, $file);

        foreach ($jobs[0] as $job) {
            $jobList[] = [
                'id' => $job[0],
                'oncelik' => $job[1],
                'kullaniciYapilacakIslerKodu' => $job[2] ?? 1,
                'Turu' => $request->type,
                'firmaTuru' => $request->commercialCompanyId,
            ];
        }

        $setJobsExcelResponse = $this->jobsSystemService->SetJobsExcel($jobList);
        if ($setJobsExcelResponse->isSuccess()) {
            return $this->success(
                $setJobsExcelResponse->getMessage(),
                $setJobsExcelResponse->getData(),
                $setJobsExcelResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setJobsExcelResponse->getMessage(),
                $setJobsExcelResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetJobsWithIdRequest $request
     */
    public function setJobsWithId(SetJobsWithIdRequest $request)
    {
        $jobList = [[
            'id' => $request->id,
            'oncelik' => $request->priority,
            'kullaniciYapilacakIslerKodu' => $request->code ?? 1,
            'Turu' => $request->typeId,
            'firmaTuru' => $request->commercialCompanyId,
        ]];
        $setJobsExcelResponse = $this->jobsSystemService->SetJobsExcel($jobList);
        if ($setJobsExcelResponse->isSuccess()) {
            return $this->success(
                $setJobsExcelResponse->getMessage(),
                $setJobsExcelResponse->getData(),
                $setJobsExcelResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setJobsExcelResponse->getMessage(),
                $setJobsExcelResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetJobsClosedExcelRequest $request
     */
    public function setJobsClosedExcel(SetJobsClosedExcelRequest $request)
    {
        $file = $request->file('file');

        $jobList = [];
        $jobs = Excel::toCollection(null, $file);

        foreach ($jobs[0] as $job) {
            $jobList[] = [
                'id' => intval($job[0]),
                'firmaTuru' => $request->commercialCompanyId,
            ];
        }

        $setJobsClosedExcelResponse = $this->jobsSystemService->SetJobsClosedExcel($jobList);
        if ($setJobsClosedExcelResponse->isSuccess()) {
            return $this->success(
                $setJobsClosedExcelResponse->getMessage(),
                $setJobsClosedExcelResponse->getData(),
                $setJobsClosedExcelResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setJobsClosedExcelResponse->getMessage(),
                $setJobsClosedExcelResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetJobSuspendRequest $request
     */
    public function setJobSuspend(SetJobSuspendRequest $request)
    {
        $setJobSuspendResponse = $this->jobsSystemService->SetJobSuspend();
        if ($setJobSuspendResponse->isSuccess()) {
            return $this->success(
                $setJobSuspendResponse->getMessage(),
                $setJobSuspendResponse->getData(),
                $setJobSuspendResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setJobSuspendResponse->getMessage(),
                $setJobSuspendResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetJobCaseWorkDeleteRequest $request
     */
    public function setJobCaseWorkDelete(SetJobCaseWorkDeleteRequest $request)
    {
        $setJobCaseWorkDeleteResponse = $this->jobsSystemService->SetJobCaseWorkDelete(
            $request->id
        );
        if ($setJobCaseWorkDeleteResponse->isSuccess()) {
            return $this->success(
                $setJobCaseWorkDeleteResponse->getMessage(),
                $setJobCaseWorkDeleteResponse->getData(),
                $setJobCaseWorkDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setJobCaseWorkDeleteResponse->getMessage(),
                $setJobCaseWorkDeleteResponse->getStatusCode()
            );
        }
    }
}
