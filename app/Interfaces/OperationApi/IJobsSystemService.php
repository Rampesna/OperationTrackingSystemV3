<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface IJobsSystemService
{
    /**
     * @param array $jobList
     *
     * @return ServiceResponse
     */
    public function SetJobsExcel(
        array $jobList
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $priority
     * @param int $type
     *
     * @return ServiceResponse
     */
    public function SetJobsUyumIsId(
        int $id,
        int $priority,
        int $type
    ): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function SetJobSuspend(): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetJobCaseWorkDelete(
        int $id
    ): ServiceResponse;

    /**
     * @param array $jobList
     *
     * @return ServiceResponse
     */
    public function SetJobsClosedExcel(
        array $jobList
    ): ServiceResponse;
}
