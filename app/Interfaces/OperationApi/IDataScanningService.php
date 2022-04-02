<?php


namespace App\Interfaces\OperationApi;

interface IDataScanningService
{
    public function GetDataScanTables();

    public function SetDataScanning(
        $jobList
    );

    public function SetCallDataScanning(
        $list
    );

    public function GetDataScanNumbersList(
        $startDate,
        $endDate,
        $tableName,
        $officeCodes
    );

    public function GetDataScanSummaryList(
        $startDate,
        $endDate,
        $officeCodes
    );

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
