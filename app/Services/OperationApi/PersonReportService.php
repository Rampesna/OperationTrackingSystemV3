<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IPersonReportService;
use App\Services\ServiceResponse;
use GuzzleHttp\Client;

class PersonReportService extends OperationApiService implements IPersonReportService
{
    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonReport(
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'baslangicTarihi' => $startDate,
            'bitisTarihi' => $endDate
        ];

        return new ServiceResponse(
            true,
            'Get person report',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function GetPersonLogReport(
        string $startDate,
        string $endDate,
        array  $list
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonLogReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        $client = new Client;
        $response = $client->request('get', $this->baseUrl . $endpoint, [
            'headers' => $headers,
            'body' => json_encode($list),
            'query' => $parameters
        ]);

        return new ServiceResponse(
            true,
            'Get person log report',
            200,
            json_decode($response->getBody())->response
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function GetSinglePersonLogReport(
        string $startDate,
        string $endDate,
        int    $employeeId
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetSinglePersonLogReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
            'PersonelId' => $employeeId
        ];

        return new ServiceResponse(
            true,
            'Get single person log report',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function GetPersonScreenLogReport(
        string $startDate,
        string $endDate,
        array  $list
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonScreenLogReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        $client = new Client;
        $response = $client->request('get', $this->baseUrl . $endpoint, [
            'headers' => $headers,
            'body' => json_encode($list),
            'query' => $parameters
        ]);

        return new ServiceResponse(
            true,
            'Get person screen log report',
            200,
            json_decode($response->getBody())->response
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetPersonPenalties(
        int $id
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonPenalties";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'PersonId' => $id
        ];

        return new ServiceResponse(
            true,
            'Get person penalties',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetAchievementPointsSingleDetails(
        int $id
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetAchievementPointsSingleDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'PersonId' => $id
        ];

        return new ServiceResponse(
            true,
            'Get achievement points single details',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetPersonPenaltiesDetails(
        int $id
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonPenaltiesDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'PersonId' => $id
        ];

        return new ServiceResponse(
            true,
            'Get person penalties details',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param array $employeeGuids
     *
     * @return ServiceResponse
     */
    public function GetPersonnelAchievementRanking(
        array $employeeGuids
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonnelAchievementRanking";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $client = new Client;
        $response = $client->request('get', $this->baseUrl . $endpoint, [
            'headers' => $headers,
            'body' => json_encode($employeeGuids),
            'query' => []
        ]);

        return new ServiceResponse(
            true,
            'Get personnel achievement ranking',
            200,
            json_decode($response->getBody())->response
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelJobReportList(
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonnelJobReportList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return new ServiceResponse(
            true,
            'Get personnel job report list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelBreakReportList(
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonnelBreakReportList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return new ServiceResponse(
            true,
            'Get personnel break report list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelDataScanReportList(
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonnelDataScanReportList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return new ServiceResponse(
            true,
            'Get personnel data scan report list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetPersonnelMarketingScanReportList(
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonnelMarketingScanReportList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return new ServiceResponse(
            true,
            'Get personnel marketing scan report list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

    /**
     * @param string $startDate
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetPersonShiftReport(
        string $startDate,
        array  $officeCodes
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonShiftReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
        ];

        $body = $officeCodes;

        return new ServiceResponse(
            true,
            'Get person shift report',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $body)['response']
        );
    }

    /**
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetPersonAppointmentReport(
        array $officeCodes
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonAppointmentReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get person appointment report',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $officeCodes)['response']
        );
    }

    /**
     * @param array $officeCodes
     *
     * @return ServiceResponse
     */
    public function GetPersonLeaveTheJobReport(
        array $officeCodes
    ): ServiceResponse
    {
        $endpoint = "PersonReport/GetPersonLeaveTheJobReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get person leave the job report',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $officeCodes)['response']
        );
    }
}
