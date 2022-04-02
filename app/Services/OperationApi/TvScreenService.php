<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\ITvScreenService;

class TvScreenService extends OperationApiService implements ITvScreenService
{
    public function GetJobList()
    {
        $endpoint = "TvScreen/GetJobList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetStaffStatusList($companyId)
    {
        $endpoint = "TvScreen/GetStaffStatusList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'CompanyId' => $companyId
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'get', $headers, $params);
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
