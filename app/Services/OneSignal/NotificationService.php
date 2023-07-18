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
//            'big_picture' => asset('assets/media/misc/birthdayCard.jpg'),
//            'chrome_web_image' => asset('assets/media/misc/birthdayCard.jpg'),
//            'firefox_icon' => asset('assets/media/misc/birthdayCard.jpg'),
//            'chrome_icon' => asset('assets/media/misc/birthdayCard.jpg'),
//            'chrome_big_picture' => asset('assets/media/misc/birthdayCard.jpg'),
//            'adm_small_icon ' => asset('assets/media/misc/birthdayCard.jpg'),
        ], $message);

        return new ServiceResponse(
            true,
            'Notifications sent',
            200,
            null
        );
    }
}
