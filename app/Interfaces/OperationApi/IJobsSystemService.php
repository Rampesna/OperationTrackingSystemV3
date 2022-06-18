<?php


namespace App\Interfaces\OperationApi;

interface IJobsSystemService
{
    /**
     * @param array $jobList
     */
    public function SetJobsExcel(
        array $jobList
    );

    public function SetJobsUyumIsId(
        $id,
        $priority,
        $type
    );

    public function SetJobSuspend();

    /**
     * @param string|int $id
     */
    public function SetJobCaseWorkDelete(
        string|int $id
    );

    /**
     * @param array $jobList
     */
    public function SetJobsClosedExcel(
        array $jobList
    );
}
