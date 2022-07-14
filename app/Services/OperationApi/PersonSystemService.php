<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IPersonSystemService;
use App\Services\ServiceResponse;

class PersonSystemService extends OperationApiService implements IPersonSystemService
{
    /**
     * @param array $guids
     * @param int $education
     * @param int $assignment
     * @param int $teamLead
     * @param int $teamLeadAssistant
     *
     * @return ServiceResponse
     */
    public function SetPersonAuthority(
        array $guids,
        int   $education,
        int   $assignment,
        int   $teamLead,
        int   $teamLeadAssistant
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set person authority',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

    /**
     * @param int $otsLockType
     * @param array $guids
     *
     * @return ServiceResponse
     */
    public function SetPersonDisplayType(
        int   $otsLockType,
        array $guids
    ): ServiceResponse
    {
        $endpoint = "PersonSystem/SetPersonDisplayType";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $list = [];
        foreach ($guids as $guid) {
            $list[] = [
                'id' => $guid,
                "ekranKilitTuru" => $otsLockType
            ];
        }

        return new ServiceResponse(
            true,
            'Set person display type',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetPersonDataScanList(): ServiceResponse
    {
        $endpoint = "PersonSystem/GetPersonDataScanList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get person data scan list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @param int $groupCode
     * @param array $guids
     *
     * @return ServiceResponse
     */
    public function SetPersonDataScan(
        int   $groupCode,
        array $guids
    ): ServiceResponse
    {
        $endpoint = "PersonSystem/SetPersonDataScan";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $list = [];
        foreach ($guids as $guid) {
            $list[] = [
                'grupKodu' => $groupCode,
                'personId' => $guid
            ];
        }

        return new ServiceResponse(
            true,
            'Set person data scan',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

    /**
     * @param int $jobCode
     * @param array $guids
     *
     * @return ServiceResponse
     */
    public function SetPersonWorkToDoType(
        int   $jobCode,
        array $guids
    ): ServiceResponse
    {
        $endpoint = "PersonSystem/SetPersonWorkToDoType";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $list = [];
        foreach ($guids as $guid) {
            $list[] = [
                'id' => $guid,
                'yapilacakIslerKodu' => $jobCode
            ];
        }

        return new ServiceResponse(
            true,
            'Set person work to do type',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }
}
