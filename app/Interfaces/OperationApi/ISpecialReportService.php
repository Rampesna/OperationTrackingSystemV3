<?php


namespace App\Interfaces\OperationApi;

interface ISpecialReportService
{
    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $query
     */
    public function GetSpecialReport(
        string $startDate,
        string $endDate,
        string $query
    );
}
