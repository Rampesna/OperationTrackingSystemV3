<?php

namespace App\Services\QuizApp;

use Illuminate\Support\Facades\Http;

abstract class QuizAppService
{
    /**
     * @var string $baseUrl
     */
    protected $baseUrl;

    /**
     * @var string $token
     */
    public $token;

    public function __construct()
    {
        $this->baseUrl = 'https://quizapp.ayssoft.com/';
        $quizAppAccessTokenFromSession = $_SESSION['quizAppAccessToken'] ?? null;
        if (!$quizAppAccessTokenFromSession) {
            $this->token = $this->login();
            $_SESSION['quizAppAccessToken'] = $this->token;
        } else {
            $this->token = $_SESSION['quizAppAccessToken'];
        }
    }

    public function callApi($url, $method, $headers = [], $params = [], $body = [])
    {
        return Http::withHeaders($headers)->$method($url, $params);
    }

    public function login()
    {
        $endpoint = 'api/v1/auth/login';

        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
        ];

        $params = [
            'email' => 'ays@ayssoft.com',
            'password' => 'ays1234'
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params)['data']['token'];
    }
}
