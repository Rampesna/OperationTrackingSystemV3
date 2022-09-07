<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IDataScanningService;
use App\Services\ServiceResponse;

class DataScanningService extends OperationApiService implements IDataScanningService
{
    /**
     * @return ServiceResponse
     */
    public function GetDataScanTables(): ServiceResponse
    {
        $endpoint = "DataScanning/GetDataScanTables";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get data scan tables',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @param array $jobList
     *
     * @return ServiceResponse
     */
    public function SetDataScanning(
        array $jobList
    ): ServiceResponse
    {
        $endpoint = "DataScanning/SetDataScanning";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set data scanning',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $jobList)
        );
    }

    /**
     * @param array $jobList
     *
     * @return ServiceResponse
     */
    public function SetCallDataScanning(
        array $jobList
    ): ServiceResponse
    {
        $endpoint = "DataScanning/SetCallDataScanning";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set call data scanning',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $jobList)
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Get data scan numbers list',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $officeCodes)['response']
        );
    }

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
    ): ServiceResponse
    {
        $endpoint = "DataScanning/GetDataScanSummaryList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return new ServiceResponse(
            true,
            'Get data scan summary list',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $officeCodes)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Get data scanning details',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $officeCodes)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set data scan tables',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetDataScanGibList(
        string $startDate,
        string $endDate,
        array  $officeCodes
    ): ServiceResponse
    {
        $endpoint = "DataScanning/GetDataScanGibList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return new ServiceResponse(
            true,
            'Get data scan gib list',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $officeCodes)['response']
        );
    }
}
