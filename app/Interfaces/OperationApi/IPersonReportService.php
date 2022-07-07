<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface IPersonReportService
{
    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonReport(
        string $startDate,
        string $endDate
    );

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function GetPersonLogReport(
        string $startDate,
        string $endDate,
        array  $list
    );

    /**
     * @param string $startDate
     * @param string $endDate
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function GetSinglePersonLogReport(
        string $startDate,
        string $endDate,
        int    $employeeId
    );

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function GetPersonScreenLogReport(
        string $startDate,
        string $endDate,
        array  $list
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetPersonPenalties(
        int $id
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetAchievementPointsSingleDetails(
        int $id
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetPersonPenaltiesDetails(
        int $id
    );

    /**
     * @param array $employeeGuids
     *
     * @return ServiceResponse
     */
    public function GetPersonnelAchievementRanking(
        array $employeeGuids
    );

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelJobReportList(
        string $startDate,
        string $endDate
    );

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelBreakReportList(
        string $startDate,
        string $endDate
    );

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelDataScanReportList(
        string $startDate,
        string $endDate
    );

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelMarketingScanReportList(
        string $startDate,
        string $endDate
    );

    /**
     * @param string $startDate
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetPersonShiftReport(
        string $startDate,
        array  $officeCodes
    );

    /**
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetPersonAppointmentReport(
        array $officeCodes
    );

    /**
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetPersonLeaveTheJobReport(
        array $officeCodes
    );
}
