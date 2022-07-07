<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface ISpecialReportService
{
    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $query
     *
     * @return ServiceResponse
     */
    public function GetSpecialReport(
        string $startDate,
        string $endDate,
        string $query
    );
}
