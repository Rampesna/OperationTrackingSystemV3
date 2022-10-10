<?php

namespace App\Interfaces\OneSignal;

use App\Services\ServiceResponse;

interface INotificationService
{
    /**
     * @param array $deviceTokens
     * @param string $heading
     * @param string $message
     */
    public function sendNotification(
        array  $deviceTokens,
        string $heading,
        string $message
    ): ServiceResponse;
}
