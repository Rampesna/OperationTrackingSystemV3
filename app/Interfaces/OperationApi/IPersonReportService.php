<?php


namespace App\Interfaces\OperationApi;

interface IPersonReportService
{
    public function GetPersonReport(
        $startDate,
        $endDate
    );

    public function GetPersonLogReport(
        $startDate,
        $endDate,
        $list
    );

    public function GetSinglePersonLogReport(
        $startDate,
        $endDate,
        $employeeId
    );

    public function GetPersonScreenLogReport(
        $startDate,
        $endDate,
        $list
    );

    public function GetPersonPenalties(
        $id
    );

    public function GetAchievementPointsSingleDetails(
        $id
    );

    public function GetPersonPenaltiesDetails(
        $id
    );

    public function GetPersonnelAchievementRanking();

    public function GetPersonnelJobReportList(
        $startDate,
        $endDate
    );

    public function GetPersonnelBreakReportList(
        $startDate,
        $endDate
    );

    public function GetPersonnelDataScanReportList(
        $startDate,
        $endDate
    );

    public function GetPersonnelMarketingScanReportList(
        $startDate,
        $endDate
    );

    public function GetPersonShiftReport(
        $startDate,
        $officeCodes
    );

    public function GetPersonAppointmentReport(
        $officeCodes
    );

    public function GetPersonLeaveTheJobReport(
        $officeCodes
    );
}
