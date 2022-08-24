<?php

namespace App\Services\NetsantralApi;

use App\Interfaces\NetsantralApi\INetsantralApiService;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\Http;

class NetsantralApiService implements INetsantralApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('NETSANTRAL_API_BASE_URL', 'http://127.0.0.1:8066/api/');
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $headers
     * @param array $params
     * @param array $body
     */
    protected function callApi(
        $url,
        $method,
        $headers = [],
        $params = [],
        $body = []
    )
    {
        return Http::withHeaders($headers)->$method($url, $params);
    }

    /**
     * @return ServiceResponse
     */
    public function callQueues(): ServiceResponse
    {
        $endpoint = "CallQueues";
        $response = json_decode($this->callApi($this->baseUrl . $endpoint, 'get', [], [
            'appToken' => env('NETSANTRAL_API_TOKEN')
        ])->getBody());
        return new ServiceResponse(
            true,
            'Call queues',
            200,
            $response
        );
    }

    /**
     * @param string $queueShort
     *
     * @return ServiceResponse
     */
    public function abandons(
        string $queueShort
    ): ServiceResponse
    {
        $endpoint = "Abandons";
        $response = json_decode($this->callApi($this->baseUrl . $endpoint, 'get', [], [
            'appToken' => env('NETSANTRAL_API_TOKEN'),
            'queue' => $queueShort
        ])->getBody());
        return new ServiceResponse(
            true,
            'Abandons',
            200,
            $response
        );
    }
}
