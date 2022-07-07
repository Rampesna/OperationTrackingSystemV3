<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface ITvScreenService
{
    /**
     * @return ServiceResponse
     */
    public function GetJobList();

    /**
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function GetStaffStatusList(
        array $companyId
    );

    /**
     * @param array $employeeGuids
     *
     * @return ServiceResponse
     */
    public function GetStaffStatusUserList(
        array $employeeGuids
    );

    /**
     * @return ServiceResponse
     */
    public function GetStaffStarList();

    /**
     * @return ServiceResponse
     */
    public function GetPointDay();

    /**
     * @return ServiceResponse
     */
    public function GetPointWeek();

    /**
     * @return ServiceResponse
     */
    public function GetMonthJobRanking();
}
