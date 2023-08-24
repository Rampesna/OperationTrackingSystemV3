<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IFileService;
use App\Interfaces\Eloquent\ISocialEventService;
use App\Models\Eloquent\SocialEvent;
use App\Services\ServiceResponse;

class SocialEventService implements ISocialEventService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All social Events',
            200,
            SocialEvent::all()
        );
    }

    /**
     * @return ServiceResponse
     */
    public function getAllByDateOrdered(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All social Events',
            200,
            SocialEvent::orderBy('date', 'desc')->get()
        );
    }

    /**
     * @return ServiceResponse
     */
    public function getAllByDateOrderedWithImages(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All social Events',
            200,
            SocialEvent::with([
                'images'
            ])->orderBy('date', 'desc')->get()
        );
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function index(
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    ): ServiceResponse
    {
        $socialEvents = SocialEvent::orderBy('id', 'desc');

        if ($keyword) {
            $socialEvents->where(function ($careers) use ($keyword) {
                $careers->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Social events',
            200,
            [
                'totalCount' => $socialEvents->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'socialEvents' => $pageSize == -1 ? $socialEvents->get() :
                    $socialEvents->skip($pageSize * $pageIndex)
                        ->take($pageSize)
                        ->get()
            ]
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
        $socialEvent = SocialEvent::find($id);
        if ($socialEvent) {
            return new ServiceResponse(
                true,
                'Social Event',
                200,
                $socialEvent
            );
        }
        return new ServiceResponse(
            false,
            'Social Event not found',
            404,
            null
        );
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
        $socialEvent = $this->getById($id);
        if ($socialEvent->isSuccess()) {
            return new ServiceResponse(
                true,
                'Social Event deleted',
                200,
                $socialEvent->getData()->delete()
            );
        } else {
            return $socialEvent;
        }
    }

    /**
     * @param string $name
     * @param string $description
     * @param string $date
     * @param string $youtubeVideoUrl
     *
     * @return ServiceResponse
     */
    public function create(
        string $name,
        string $description,
        string $date,
        string $youtubeVideoUrl
    ): ServiceResponse
    {
        $socialEvent = new SocialEvent();
        $socialEvent->name = $name;
        $socialEvent->description = $description;
        $socialEvent->date = $date;
        $socialEvent->youtube_video_url = $youtubeVideoUrl;
        $socialEvent->save();
        return new ServiceResponse(
            true,
            'Social Event created',
            200,
            $socialEvent
        );
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $date
     * @param string $youtubeVideoUrl
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name,
        string $description,
        string $date,
        string $youtubeVideoUrl
    ): ServiceResponse
    {
        $socialEvent = $this->getById($id);
        if ($socialEvent->isSuccess()) {
            $socialEvent->getData()->name = $name;
            $socialEvent->getData()->description = $description;
            $socialEvent->getData()->date = $date;
            $socialEvent->getData()->youtube_video_url = $youtubeVideoUrl;
            $socialEvent->getData()->save();
            return new ServiceResponse(
                true,
                'Social Event updated',
                200,
                $socialEvent
            );
        } else {
            return $socialEvent;
        }
    }
}
