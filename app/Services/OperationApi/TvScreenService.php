<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\ITvScreenService;
use App\Services\ServiceResponse;
use GuzzleHttp\Client;

class TvScreenService extends OperationApiService implements ITvScreenService
{
    /**
     * @return ServiceResponse
     */
    public function GetJobList(): ServiceResponse
    {
        $endpoint = "TvScreen/GetJobList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $response = $this->callApi($this->baseUrl . $endpoint, 'get', $headers);

        return new ServiceResponse(
            true,
            'Get job list',
            200,
            json_decode($response->getBody())->response
        );
    }

    /**
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function GetStaffStatusList(
        array $companyIds
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Get staff status list',
            200,
            json_decode($response->getBody())->response
        );
    }

    /**
     * @param array $employeeGuids
     *
     * @return ServiceResponse
     */
    public function GetStaffStatusUserList(
        array $employeeGuids
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Get staff status user list',
            200,
            json_decode($response->getBody())->response
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetStaffStarList(): ServiceResponse
    {
        $endpoint = "TvScreen/GetStaffStarList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get staff star list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetPointDay(): ServiceResponse
    {
        $endpoint = "TvScreen/GetPointDay";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get point day',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetPointWeek(): ServiceResponse
    {
        $endpoint = "TvScreen/GetPointWeek";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get point week',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetMonthJobRanking(): ServiceResponse
    {
        $endpoint = "TvScreen/GetMonthJobRanking";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get month job ranking',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }
}
