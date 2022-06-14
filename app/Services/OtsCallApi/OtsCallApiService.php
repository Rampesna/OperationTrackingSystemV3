<?php

namespace App\Services\OtsCallApi;

use Illuminate\Support\Facades\Http;

abstract class OtsCallApiService
{
    protected $baseUrl;
    public $_token;

    public function __construct()
    {
        $this->baseUrl = env('OTS_CALL_API_BASE_URL', 'https://otscagriapi.ayssoft.com/api/');
        if (!isset($_SESSION['accessTokenExpireTime']) && !isset($_SESSION['accessToken'])) {
            $this->_token = $this->Login();
            $_SESSION['accessTokenExpireTime'] = time() + 10800;
            $_SESSION['accessToken'] = $this->_token;
        } else {
            if (time() > $_SESSION['accessTokenExpireTime']) {
                $this->_token = $this->Login();
                $_SESSION['accessTokenExpireTime'] = time() + 10800;
                $_SESSION['accessToken'] = $this->_token;
            } else {
                $this->_token = $_SESSION['accessToken'];
            }
        }
    }

    public function Login()
    {
        $endpoint = 'Account/Login';
        $headers = [
            'Content-Type: application/json'
        ];
        $params = [
            'Email' => 'nurullah.alisik',
            'Password' => '123'
        ];
        return $this->callApi(env('OPERATION_API_BASE_URL', 'https://operasyonapi.ayssoft.com/api/') . $endpoint, 'post', $headers, $params)['response']['accessToken'];
    }

    public function callApi($url, $method, $headers = [], $params = [], $body = [])
    {
        return Http::withHeaders($headers)->$method($url, $params);
    }
}
