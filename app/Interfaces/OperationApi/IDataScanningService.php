<?php


namespace App\Interfaces\OperationApi;

interface IDataScanningService
{
    public function GetDataScanTables();

    /**
     * @param array $jobList
     */
    public function SetDataScanning(
        array $jobList
    );

    /**
     * @param array $jobList
     */
    public function SetCallDataScanning(
        array $jobList
    );

    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $tableName
     * @param array $officeCodes
     */
    public function GetDataScanNumbersList(
        string $startDate,
        string $endDate,
        string $tableName,
        array  $officeCodes
    );

    public function GetDataScanSummaryList(
        $startDate,
        $endDate,
        $officeCodes
    );

    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $tableName
     * @param string $type
     * @param array $officeCodes
     */
    public function GetDataScanningDetails(
        $startDate,
        $endDate,
        $tableName,
        $type,
        $officeCodes
    );

    public function SetDataScanTables(
        $groupCode,
        $description,
        $tableName,
        $groupName
    );
}
