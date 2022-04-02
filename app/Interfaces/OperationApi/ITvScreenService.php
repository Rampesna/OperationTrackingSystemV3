<?php


namespace App\Interfaces\OperationApi;

interface ITvScreenService
{
    public function GetJobList();

    public function GetStaffStatusList(
        $companyId
    );

    public function GetStaffStarList();

    public function GetPointDay();

    public function GetPointWeek();

    public function GetMonthJobRanking();
}
