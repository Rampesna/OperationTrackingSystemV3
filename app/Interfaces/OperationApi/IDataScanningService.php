<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface IDataScanningService
{
    /**
     * @return ServiceResponse
     */
    public function GetDataScanTables(): ServiceResponse;

    /**
     * @param array $jobList
     *
     * @return ServiceResponse
     */
    public function SetDataScanning(
        array $jobList
    ): ServiceResponse;

    /**
     * @param array $jobList
     *
     * @return ServiceResponse
     */
    public function SetCallDataScanning(
        array $jobList
    ): ServiceResponse;

    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $tableName
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetDataScanNumbersList(
        string $startDate,
        string $endDate,
        string $tableName,
        array  $officeCodes
    ): ServiceResponse;

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetDataScanSummaryList(
        string $startDate,
        string $endDate,
        array  $officeCodes
    ): ServiceResponse;

    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $tableName
     * @param string $type
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetDataScanningDetails(
        string $startDate,
        string $endDate,
        string $tableName,
        string $type,
        array  $officeCodes
    ): ServiceResponse;

    /**
     * @param int $groupCode
     * @param string $groupCode
     * @param string $groupCode
     * @param string $groupCode
     *
     * @return ServiceResponse
     */
    public function SetDataScanTables(
        int    $groupCode,
        string $description,
        string $tableName,
        string $groupName
    ): ServiceResponse;
}
