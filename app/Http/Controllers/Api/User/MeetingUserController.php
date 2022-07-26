<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IMeetingService;
use App\Interfaces\Eloquent\IUserService;
use App\Http\Requests\Api\User\MeetingUserController\GetMeetingUsersRequest;
use App\Http\Requests\Api\User\MeetingUserController\SetMeetingUsersRequest;
use App\Http\Requests\Api\User\MeetingUserController\GetUserMeetingsRequest;
use App\Http\Requests\Api\User\MeetingUserController\SetUserMeetingsRequest;
use App\Traits\Response;

class MeetingUserController extends Controller
{
    use Response;

    /**
     * @var $meetingService
     */
    private $meetingService;

    /**
     * @var $userService
     */
    private $userService;

    /**
     * @param IMeetingService $meetingService
     * @param IUserService $userService
     */
    public function __construct(
        IMeetingService $meetingService,
        IUserService    $userService
    )
    {
        $this->meetingService = $meetingService;
        $this->userService = $userService;
    }

    /**
     * @param GetMeetingUsersRequest $request
     */
    public function getMeetingUsers(GetMeetingUsersRequest $request)
    {
        $getMeetingUsersResponse = $this->meetingService->getMeetingUsers($request->meetingId);
        if ($getMeetingUsersResponse->isSuccess()) {
            return $this->success(
                $getMeetingUsersResponse->getMessage(),
                $getMeetingUsersResponse->getData(),
                $getMeetingUsersResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getMeetingUsersResponse->getMessage(),
                $getMeetingUsersResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetMeetingUsersRequest $request
     */
    public function setMeetingUsers(SetMeetingUsersRequest $request)
    {
        $setMeetingUsersResponse = $this->meetingService->setMeetingUsers(
            $request->meetingId,
            $request->userIds
        );
        if ($setMeetingUsersResponse->isSuccess()) {
            return $this->success(
                $setMeetingUsersResponse->getMessage(),
                $setMeetingUsersResponse->getData(),
                $setMeetingUsersResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setMeetingUsersResponse->getMessage(),
                $setMeetingUsersResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetUserMeetingsRequest $request
     */
    public function getUserMeetings(GetUserMeetingsRequest $request)
    {
        $getUserMeetingsResponse = $this->userService->getUserMeetings(
            $request->userId
        );
        if ($getUserMeetingsResponse->isSuccess()) {
            return $this->success(
                $getUserMeetingsResponse->getMessage(),
                $getUserMeetingsResponse->getData(),
                $getUserMeetingsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getUserMeetingsResponse->getMessage(),
                $getUserMeetingsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetUserMeetingsRequest $request
     */
    public function setUserMeetings(SetUserMeetingsRequest $request)
    {
        $setUserMeetingsResponse = $this->userService->setUserMeetings(
            $request->userId,
            $request->meetingIds
        );
        if ($setUserMeetingsResponse->isSuccess()) {
            return $this->success(
                $setUserMeetingsResponse->getMessage(),
                $setUserMeetingsResponse->getData(),
                $setUserMeetingsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setUserMeetingsResponse->getMessage(),
                $setUserMeetingsResponse->getStatusCode()
            );
        }
    }
}
