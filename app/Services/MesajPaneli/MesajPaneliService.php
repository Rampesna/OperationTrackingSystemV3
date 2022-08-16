<?php

namespace App\Services\MesajPaneli;

use App\Interfaces\MesajPaneli\IMesajPaneliService;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\Http;

class MesajPaneliService implements IMesajPaneliService
{
    /**
     * @var $url
     */
    private $url;

    /**
     * @var $title
     */
    private $title;

    /**
     * @var $username
     */
    private $username;

    /**
     * @var $password
     */
    private $password;

    public function __construct()
    {
        $this->url = env('MESAJPANELI_URL');
        $this->title = env('MESAJPANELI_TITLE');
        $this->username = env('MESAJPANELI_USER_NAME');
        $this->password = env('MESAJPANELI_USER_PASSWORD');
    }

    /**
     * @param array $messages
     *
     * @return ServiceResponse
     */
    public function sendSms(
        array $messages
    ): ServiceResponse
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->asForm()->post($this->url, [
            'data' => base64_encode(
                json_encode([
                    'user' => [
                        'name' => $this->username,
                        'pass' => $this->password
                    ],
                    'msgBaslik' => $this->title,
                    'tr' => true,
                    'start' => 1490001000,
                    'msgData' => $messages
                ])
            )
        ]);

        if ($response->status() == 200) {
            return new ServiceResponse(
                true,
                'All messages sent successfully.',
                200,
                json_decode($response->body())
            );
        } else {
            return new ServiceResponse(
                false,
                'There was an error while sending messages.',
                400,
                json_decode($response->body())
            );
        }
    }
}
