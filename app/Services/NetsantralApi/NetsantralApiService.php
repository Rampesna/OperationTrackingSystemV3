<?php

namespace App\Services\NetsantralApi;

use App\Interfaces\NetsantralApi\INetsantralApiService;
use Illuminate\Support\Facades\Http;

class NetsantralApiService implements INetsantralApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('NETSANTRAL_API_BASE_URL', 'http://127.0.0.1:8066/api/');
    }

    public function callApi($url, $method, $headers = [], $params = [], $body = [])
    {
        return Http::withHeaders($headers)->$method($url, $params);
    }

    public function callQueues()
    {
        $endpoint = "CallQueues";
        return json_decode($this->callApi($this->baseUrl . $endpoint, 'get', [], [
            'appToken' => env('NETSANTRAL_API_TOKEN')
        ])->getBody());
    }
}
