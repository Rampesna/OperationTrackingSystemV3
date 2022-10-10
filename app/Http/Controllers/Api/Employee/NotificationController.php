<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\NotificationController\IndexRequest;
use App\Interfaces\Eloquent\INotificationService;
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
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        $indexResponse = $this->notificationService->index(
            'App\\Models\\Eloquent\\Employee',
            $request->user()->id,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($indexResponse->isSuccess()) {
            return $this->success(
                $indexResponse->getMessage(),
                $indexResponse->getData(),
                $indexResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $indexResponse->getMessage(),
                $indexResponse->getStatusCode()
            );
        }
    }
}
