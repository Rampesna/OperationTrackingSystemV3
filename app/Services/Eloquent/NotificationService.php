<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\INotificationService;
use App\Models\Eloquent\Notification;
use App\Services\ServiceResponse;

class NotificationService implements INotificationService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All notifications',
            200,
            Notification::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $notification = Notification::find($id);
        if ($notification) {
            return new ServiceResponse(
                true,
                'Notification',
                200,
                $notification
            );
        } else {
            return new ServiceResponse(
                false,
                'Notification not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $notification = $this->getById($id);
        if ($notification->isSuccess()) {
            return new ServiceResponse(
                true,
                'Notification deleted',
                200,
                $notification->getData()->delete()
            );
        } else {
            return $notification;
        }
    }

    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $message
     *
     * @return ServiceResponse
     */
    public function create(
        string $relationType,
        int    $relationId,
        string $message
    ): ServiceResponse
    {
        $notification = new Notification();
        $notification->relation_type = $relationType;
        $notification->relation_id = $relationId;
        $notification->message = $message;
        $notification->save();

        return new ServiceResponse(
            true,
            'Notification created',
            200,
            $notification
        );
    }
}
