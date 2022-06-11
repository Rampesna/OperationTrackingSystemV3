<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\ISpecialReportService;

class SpecialReportService extends OperationApiService implements ISpecialReportService
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
    )
    {
        $endpoint = "SpecialReport/GetSpecialReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
            'Sorgu' => $query
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response'];
    }
}
