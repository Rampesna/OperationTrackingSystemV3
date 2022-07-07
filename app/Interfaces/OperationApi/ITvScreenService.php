<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface ITvScreenService
{
    /**
     * @return ServiceResponse
     */
    public function GetJobList(): ServiceResponse;

    /**
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function GetStaffStatusList(
        array $companyId
    ): ServiceResponse;

    /**
     * @param array $employeeGuids
     *
     * @return ServiceResponse
     */
    public function GetStaffStatusUserList(
        array $employeeGuids
    ): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetStaffStarList(): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetPointDay(): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetPointWeek(): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetMonthJobRanking(): ServiceResponse;
}
