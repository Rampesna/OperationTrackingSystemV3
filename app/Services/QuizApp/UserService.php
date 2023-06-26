<?php


namespace App\Services\QuizApp;

use App\Interfaces\QuizApp\IUserService;
use App\Services\ServiceResponse;
use GuzzleHttp\Client;

class UserService extends QuizAppService implements IUserService
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function create(
        string $name,
        string $email,
        string $password
    ): ServiceResponse
    {
        $endpoint = "api/v1/users/createUser";
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $params = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => 'user'
        ];

        $response = $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);

        return new ServiceResponse(
            $response['success'],
            $response['message'],
            $response['status'],
            $response['data']
        );
    }
}
