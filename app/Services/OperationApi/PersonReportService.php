<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IPersonReportService;
use GuzzleHttp\Client;

class PersonReportService extends OperationApiService implements IPersonReportService
{
    public function GetPersonReport($startDate, $endDate)
    {
        $endpoint = "PersonReport/GetPersonReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'baslangicTarihi' => $startDate,
            'bitisTarihi' => $endDate
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function GetPersonLogReport($startDate, $endDate, $list)
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

        return $response;
    }

    public function GetSinglePersonLogReport($startDate, $endDate, $employeeId)
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

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function GetPersonScreenLogReport($startDate, $endDate, $list)
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

        return $response;

//        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);

//        return $response->getBody();
    }

    public function GetPersonPenalties($id)
    {
        $endpoint = "PersonReport/GetPersonPenalties";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'PersonId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'get', $headers, $parameters);
    }

    public function GetAchievementPointsSingleDetails($id)
    {
        $endpoint = "PersonReport/GetAchievementPointsSingleDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'PersonId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'get', $headers, $parameters);
    }

    public function GetPersonPenaltiesDetails($id)
    {
        $endpoint = "PersonReport/GetPersonPenaltiesDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'PersonId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'get', $headers, $parameters);
    }

    public function GetPersonnelAchievementRanking()
    {
        $endpoint = "PersonReport/GetPersonnelAchievementRanking";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetPersonnelJobReportList($startDate, $endDate)
    {
        $endpoint = "PersonReport/GetPersonnelJobReportList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetPersonnelBreakReportList($startDate, $endDate)
    {
        $endpoint = "PersonReport/GetPersonnelBreakReportList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetPersonnelDataScanReportList($startDate, $endDate)
    {
        $endpoint = "PersonReport/GetPersonnelDataScanReportList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetPersonnelMarketingScanReportList($startDate, $endDate)
    {
        $endpoint = "PersonReport/GetPersonnelMarketingScanReportList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetPersonShiftReport($startDate, $officeCodes)
    {
        $endpoint = "PersonReport/GetPersonShiftReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'BaslangicTarihi' => $startDate,
        ];

        $body = $officeCodes;

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $body);
    }

    public function GetPersonAppointmentReport($officeCodes)
    {
        $endpoint = "PersonReport/GetPersonAppointmentReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $officeCodes);
    }

    public function GetPersonLeaveTheJobReport($officeCodes)
    {
        $endpoint = "PersonReport/GetPersonLeaveTheJobReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $officeCodes);
    }
}
