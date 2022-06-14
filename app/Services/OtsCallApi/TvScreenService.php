<?php


namespace App\Services\OtsCallApi;

use App\Interfaces\OtsCallApi\ITvScreenService;

class TvScreenService extends OtsCallApiService implements ITvScreenService
{
    public function GetSantral()
    {
        $endpoint = "TvScreen/GetSantral";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }
}
