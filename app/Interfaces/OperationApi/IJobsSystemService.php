<?php


namespace App\Interfaces\OperationApi;

interface IJobsSystemService
{
    public function SetJobsExcel(
        $jobList
    );

    public function SetJobsUyumIsId(
        $id,
        $priority,
        $type
    );

    public function SetJobSuspend();

    public function SetJobCaseWorkDelete(
        $id
    );

    public function SetJobsClosedExcel(
        $jobList
    );
}
