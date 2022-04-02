<?php


namespace App\Services\OperationApi;

class PersonSystemService extends OperationApiService
{
    public function SetPersonAuthority($list)
    {
        $endpoint = "PersonSystem/SetPersonAuthority";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetPersonDisplayType($list)
    {
        $endpoint = "PersonSystem/SetPersonDisplayType";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function GetPersonDataScanList()
    {
        $endpoint = "PersonSystem/GetPersonDataScanList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function SetPersonDataScan($list)
    {
        $endpoint = "PersonSystem/SetPersonDataScan";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetPersonWorkToDoType($list)
    {
        $endpoint = "PersonSystem/SetPersonWorkToDoType";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }
}
