<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\ISpecialReportService;

class SpecialReportService extends OperationApiService implements ISpecialReportService
{
    public function GetSpecialReport($startDate, $endDate, $query)
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

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }
}
