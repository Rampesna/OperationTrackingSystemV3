<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\JobsSystemController\SetJobsExcelRequest;
use App\Http\Requests\Api\User\OperationApi\JobsSystemController\SetJobsClosedExcelRequest;
use App\Http\Requests\Api\User\OperationApi\JobsSystemController\SetJobCaseWorkDeleteRequest;
use App\Interfaces\OperationApi\IJobsSystemService;
use App\Traits\Response;
use Maatwebsite\Excel\Facades\Excel;

class JobsSystemController extends Controller
{
    use Response;

    private $jobsSystemService;

    public function __construct(IJobsSystemService $jobsSystemService)
    {
        $this->jobsSystemService = $jobsSystemService;
    }

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

        return $this->success('Jobs', $this->jobsSystemService->SetJobsExcel($jobList));
    }

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

        return $this->success('Jobs', $this->jobsSystemService->SetJobsClosedExcel($jobList));
    }

    public function setJobSuspend()
    {
        return $this->success('Jobs', $this->jobsSystemService->SetJobSuspend());
    }

    public function setJobCaseWorkDelete(SetJobCaseWorkDeleteRequest $request)
    {
        return $this->success('Jobs', $this->jobsSystemService->SetJobCaseWorkDelete(
            $request->id
        ));
    }
}
