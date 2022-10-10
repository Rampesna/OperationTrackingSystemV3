<?php

namespace App\Services\OneSignal;

use App\Interfaces\OneSignal\INotificationService;
use App\Models\Eloquent\Employee;
use App\Services\ServiceResponse;
use Ladumor\OneSignal\OneSignal;

class NotificationService implements INotificationService
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
    ): ServiceResponse
    {
        OneSignal::sendPush([
            'include_player_ids' => $deviceTokens,
            'name' => $heading,
            'headings' => [
                'en' => $heading,
                'tr' => $heading,
            ],
            'contents' => [
                'en' => $message,
                'tr' => $message,
            ],
        ], $message);

        return new ServiceResponse(
            true,
            'Notifications sent',
            200,
            null
        );
    }
}
