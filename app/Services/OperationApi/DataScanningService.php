<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IDataScanningService;

class DataScanningService extends OperationApiService implements IDataScanningService
{
    public function GetDataScanTables()
    {
        $endpoint = "DataScanning/GetDataScanTables";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response'];
    }

    public function SetDataScanning(
        array $jobList
    )
    {
        $endpoint = "DataScanning/SetDataScanning";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $jobList);
    }

    public function SetCallDataScanning(
        array $jobList
    )
    {
        $endpoint = "DataScanning/SetCallDataScanning";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $jobList)->getBody()->getContents();
    }

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
    )
    {
        $endpoint = "DataScanning/GetDataScanNumbersList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
            'TabloAdi' => $tableName
        ];

        $body = $officeCodes;

//        return $parameters;

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $body)['response'];
    }

    public function GetDataScanSummaryList(
        $startDate,
        $endDate,
        $officeCodes
    )
    {
        $endpoint = "DataScanning/GetDataScanSummaryList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        $body = $officeCodes;

//        return $parameters;

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $body)['response'];
    }

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
    )
    {
        $endpoint = "DataScanning/GetDataScanningDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
            'TabloAdi' => $tableName,
            'Tur' => $type
        ];

        $body = $officeCodes;

//        return $parameters;

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $body)['response'];
    }

    public function SetDataScanTables(
        $groupCode,
        $description,
        $tableName,
        $groupName
    )
    {
        $endpoint = "DataScanning/SetDataScanTables";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'grupKodu' => $groupCode,
            'aciklama' => $description,
            'tabloAdi' => $tableName,
            'grupAdi' => $groupName
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }
}
