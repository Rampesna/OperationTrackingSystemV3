<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\ITvScreenService;
use GuzzleHttp\Client;

class TvScreenService extends OperationApiService implements ITvScreenService
{
    public function GetJobList()
    {
        $endpoint = "TvScreen/GetJobList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return json_decode($this->callApi($this->baseUrl . $endpoint, 'get', $headers)->getBody())->response;
    }

    /**
     * @param array $companyIds
     */
    public function GetStaffStatusList(
        array $companyIds
    )
    {
        $companies = [];

        foreach ($companyIds as $companyId) {
            $companies[] = intval($companyId);
        }

        $endpoint = "TvScreen/GetStaffStatusList";

        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $client = new Client;
        $response = $client->request('post', $this->baseUrl . $endpoint, [
            'headers' => $headers,
            'body' => json_encode($companies),
            'query' => []
        ]);

        return json_decode($response->getBody())->response;
    }

    /**
     * @param array $employeeGuids
     */
    public function GetStaffStatusUserList(
        array $employeeGuids
    )
    {
        $endpoint = "TvScreen/GetStaffStatusUserList";

        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $client = new Client;
        $response = $client->request('post', $this->baseUrl . $endpoint, [
            'headers' => $headers,
            'body' => json_encode($employeeGuids),
            'query' => []
        ]);

        return json_decode($response->getBody())->response;
    }

    public function GetStaffStarList()
    {
        $endpoint = "TvScreen/GetStaffStarList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetPointDay()
    {
        $endpoint = "TvScreen/GetPointDay";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetPointWeek()
    {
        $endpoint = "TvScreen/GetPointWeek";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetMonthJobRanking()
    {
        $endpoint = "TvScreen/GetMonthJobRanking";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }
}
