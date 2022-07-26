<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IMeetingTypeService;
use App\Http\Requests\Api\User\MeetingTypeController\GetAllRequest;
use App\Traits\Response;

class MeetingTypeController extends Controller
{
    use Response;

    /**
     * @var $meetingTypeService
     */
    private $meetingTypeService;

    /**
     * @param IMeetingTypeService $meetingTypeService
     */
    public function __construct(IMeetingTypeService $meetingTypeService)
    {
        $this->meetingTypeService = $meetingTypeService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->meetingTypeService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }
}
