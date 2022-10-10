<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\NotificationController\SendForPenaltyRequest;
use App\Http\Requests\Api\User\NotificationController\SendBatchRequest;
use App\Interfaces\Eloquent\INotificationService;
use App\Models\Eloquent\Employee;
use App\Services\OneSignal\NotificationService;
use App\Traits\Response;

class NotificationController extends Controller
{
    use Response;

    /**
     * @var $notificationService
     */
    private $notificationService;

    /**
     * @param INotificationService $notificationService
     */
    public function __construct(INotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * @param SendBatchRequest $request
     */
    public function sendBatch(SendBatchRequest $request)
    {
        foreach ($request->employeeIds as $employeeId) {
            $employee = Employee::find($employeeId);
            $createResponse = $this->notificationService->create(
                'App\\Models\\Eloquent\\Employee',
                $employee->id,
                $request->heading,
                $request->message
            );
            if ($createResponse->isSuccess()) {
                $oneSignalNotificationService = new NotificationService;
                $oneSignalNotificationService->sendNotification(
                    [
                        $employee->device_token
                    ],
                    $request->heading,
                    $request->message
                );
            }
        }

        return $this->success('Notifications sent', []);
    }

    /**
     * @param SendForPenaltyRequest $request
     */
    public function sendForPenalty(SendForPenaltyRequest $request)
    {
        $employee = Employee::where('guid', $request->guid)->first();
        $heading = 'Mola Aşımı!';
        $message = 'Mola sürenizi aştığınız için ceza puanı aldınız.';

        $createResponse = $this->notificationService->create(
            'App\\Models\\Eloquent\\Employee',
            $employee->id,
            $heading,
            $message
        );
        if ($createResponse->isSuccess()) {
            $oneSignalNotificationService = new NotificationService;
            $oneSignalNotificationService->sendNotification(
                [
                    $employee->device_token
                ],
                $heading,
                $message
            );

            return $this->success('Notification sent', []);
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }
}
