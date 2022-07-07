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
    ): ServiceResponse;

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
    ): ServiceResponse;

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
    ): ServiceResponse;

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
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetPersonPenalties(
        int $id
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetAchievementPointsSingleDetails(
        int $id
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetPersonPenaltiesDetails(
        int $id
    ): ServiceResponse;

    /**
     * @param array $employeeGuids
     *
     * @return ServiceResponse
     */
    public function GetPersonnelAchievementRanking(
        array $employeeGuids
    ): ServiceResponse;

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelJobReportList(
        string $startDate,
        string $endDate
    ): ServiceResponse;

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelBreakReportList(
        string $startDate,
        string $endDate
    ): ServiceResponse;

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelDataScanReportList(
        string $startDate,
        string $endDate
    ): ServiceResponse;

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelMarketingScanReportList(
        string $startDate,
        string $endDate
    ): ServiceResponse;

    /**
     * @param string $startDate
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetPersonShiftReport(
        string $startDate,
        array  $officeCodes
    ): ServiceResponse;

    /**
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetPersonAppointmentReport(
        array $officeCodes
    ): ServiceResponse;

    /**
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetPersonLeaveTheJobReport(
        array $officeCodes
    ): ServiceResponse;
}
