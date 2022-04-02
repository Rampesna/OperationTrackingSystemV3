<?php


namespace App\Interfaces\OperationApi;

interface ISpecialReportService
{
    public function GetSpecialReport(
        $startDate,
        $endDate,
        $query
    );
}
