<?php


namespace App\Interfaces\OperationApi;

interface ITvScreenService
{
    public function GetJobList();

    /**
     * @param array $companyIds
     */
    public function GetStaffStatusList(
        array $companyId
    );

    /**
     * @param array $employeeGuids
     */
    public function GetStaffStatusUserList(
        array $employeeGuids
    );

    public function GetStaffStarList();

    public function GetPointDay();

    public function GetPointWeek();

    public function GetMonthJobRanking();
}
