<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\ISpecialReportService;
use App\Services\ServiceResponse;

class SpecialReportService extends OperationApiService implements ISpecialReportService
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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Get Special Report',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }
}
