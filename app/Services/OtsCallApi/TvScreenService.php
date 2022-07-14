<?php


namespace App\Services\OtsCallApi;

use App\Interfaces\OtsCallApi\ITvScreenService;
use App\Services\ServiceResponse;

class TvScreenService extends OtsCallApiService implements ITvScreenService
{
    /**
     * @return ServiceResponse
     */
    public function GetSantral(): ServiceResponse
    {
        $endpoint = "TvScreen/GetSantral";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];
        return new ServiceResponse(
            true,
            'Get Santral',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)
        );
    }
}
