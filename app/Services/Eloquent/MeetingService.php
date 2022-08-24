<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IMeetingService;
use App\Interfaces\Eloquent\IUserService;
use App\Models\Eloquent\Meeting;
use App\Services\ServiceResponse;

class MeetingService implements IMeetingService
{
    /**
     * @var $userService
     */
    private $userService;

    /**
     * @param IUserService $userService
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All meetings',
            200,
            Meeting::all()
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
        $meeting = Meeting::with([
            'type',
            'users'
        ])->find($id);
        if ($meeting) {
            return new ServiceResponse(
                true,
                'Meeting',
                200,
                $meeting
            );
        } else {
            return $meeting;
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
        $meeting = $this->getById($id);
        if ($meeting->isSuccess()) {
            return new ServiceResponse(
                true,
                'Meeting deleted',
                200,
                $meeting->getData()->delete()
            );
        } else {
            return $meeting;
        }
    }

    /**
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getDateBetweenByUserId(
        int     $userId,
        string  $startDate,
        string  $endDate,
        ?string $keyword
    ): ServiceResponse
    {
        $userMeetingsResponse = $this->userService->getMeetings($userId);
        if ($userMeetingsResponse->isSuccess()) {
            $meetings = Meeting::where(function ($meetings) use ($userMeetingsResponse, $userId) {
                $meetings->whereIn('id', $userMeetingsResponse->getData()->pluck('id')->toArray())->orWhere('creator_id', $userId);
            })->
            whereBetween('start_date', [$startDate, $endDate])->
            when($keyword, function ($meetings) use ($keyword) {
                return $meetings->where('title', 'like', '%' . $keyword . '%');
            })->get();
            return new ServiceResponse(
                true,
                'Meetings',
                200,
                $meetings
            );
        } else {
            return $userMeetingsResponse;
        }
    }

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getAllByUserId(
        int $userId
    ): ServiceResponse
    {
        $userMeetingsResponse = $this->userService->getMeetings($userId);
        if ($userMeetingsResponse->isSuccess()) {
            $meetings = Meeting::where(function ($meetings) use ($userMeetingsResponse, $userId) {
                $meetings->whereIn('id', $userMeetingsResponse->getData()->pluck('id')->toArray())->orWhere('creator_id', $userId);
            })->get();
            return new ServiceResponse(
                true,
                'Meetings',
                200,
                $meetings
            );
        } else {
            return $userMeetingsResponse;
        }
    }

    /**
     * @param int $meetingId
     *
     * @return ServiceResponse
     */
    public function getMeetingUsers(
        int $meetingId,
    ): ServiceResponse
    {
        $meeting = $this->getById($meetingId);
        if ($meeting->isSuccess()) {
            return new ServiceResponse(
                true,
                'Meeting users',
                200,
                $meeting->getData()->users
            );
        } else {
            return $meeting;
        }
    }

    /**
     * @param int $meetingId
     * @param array $userIds
     *
     * @return ServiceResponse
     */
    public function setMeetingUsers(
        int   $meetingId,
        array $userIds
    ): ServiceResponse
    {
        $meeting = $this->getById($meetingId);
        if ($meeting->isSuccess()) {
            $meeting->getData()->users()->sync($userIds);
            return new ServiceResponse(
                true,
                'Meeting users',
                200,
                $meeting->getData()->users
            );
        } else {
            return $meeting;
        }
    }

    /**
     * @param int $creatorId
     * @param string $name
     * @param string|null $description
     * @param string $startDate
     * @param string $endDate
     * @param string $location
     * @param int $typeId
     *
     * @return ServiceResponse
     */
    public function create(
        int     $creatorId,
        string  $name,
        ?string $description,
        string  $startDate,
        string  $endDate,
        string  $location,
        int     $typeId
    ): ServiceResponse
    {
        $meeting = new Meeting;
        $meeting->creator_id = $creatorId;
        $meeting->name = $name;
        $meeting->description = $description;
        $meeting->start_date = $startDate;
        $meeting->end_date = $endDate;
        $meeting->location = $location;
        $meeting->type_id = $typeId;
        $meeting->save();

        return new ServiceResponse(
            true,
            'Meeting created',
            201,
            $meeting
        );
    }

    /**
     * @param int $id
     * @param int $creatorId
     * @param string $name
     * @param string|null $description
     * @param string $startDate
     * @param string $endDate
     * @param string $location
     * @param int $typeId
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $creatorId,
        string  $name,
        ?string $description,
        string  $startDate,
        string  $endDate,
        string  $location,
        int     $typeId
    ): ServiceResponse
    {
        $meeting = $this->getById($id);
        if ($meeting->isSuccess()) {
            if ($meeting->getData()->creator_id != $creatorId) {
                return new ServiceResponse(
                    false,
                    'You are not allowed to update this meeting',
                    403,
                    null
                );
            } else {
                $meeting->getData()->creator_id = $creatorId;
                $meeting->getData()->name = $name;
                $meeting->getData()->description = $description;
                $meeting->getData()->start_date = $startDate;
                $meeting->getData()->end_date = $endDate;
                $meeting->getData()->location = $location;
                $meeting->getData()->type_id = $typeId;
                $meeting->getData()->save();

                return new ServiceResponse(
                    true,
                    'Meeting updated',
                    20,
                    $meeting->getData()
                );
            }
        } else {
            return $meeting;
        }
    }
}
