<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IPersonSystemService;

class PersonSystemService extends OperationApiService implements IPersonSystemService
{
    public function SetPersonAuthority(
        $guids,
        $education,
        $assignment,
        $teamLead,
        $teamLeadAssistant
    )
    {
        $endpoint = "PersonSystem/SetPersonAuthority";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $list = [];
        foreach ($guids as $guid) {
            $list[] = [
                "id" => $guid,
                "yetkiEgitim" => $education,
                "yetkiGorevlendirme" => $assignment,
                "takimLideri" => $teamLead,
                "takimLideriYardimcisi" => $teamLeadAssistant
            ];
        }

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response'];
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

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response'];
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
