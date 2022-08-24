<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IMeetingAgendaService;
use App\Models\Eloquent\MeetingAgenda;
use App\Services\ServiceResponse;

class MeetingAgendaService implements IMeetingAgendaService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All meeting agendas',
            200,
            MeetingAgenda::all()
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
        $meetingAgenda = MeetingAgenda::find($id);
        if ($meetingAgenda) {
            return new ServiceResponse(
                true,
                'Meeting agenda',
                200,
                $meetingAgenda
            );
        } else {
            return new ServiceResponse(
                false,
                'Meeting agenda not found',
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
        $meetingAgenda = $this->getById($id);
        if ($meetingAgenda->isSuccess()) {
            return new ServiceResponse(
                true,
                'Meeting agenda deleted',
                200,
                $meetingAgenda->getData()->delete()
            );
        } else {
            return $meetingAgenda;
        }
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param int|null $meetingId
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?int    $meetingId = null,
        ?string $keyword = null
    ): ServiceResponse
    {
        $meetingAgendas = MeetingAgenda::with([
            'meeting'
        ]);

        if ($meetingId) {
            if ($meetingId == -1) {
                $meetingAgendas->where('meeting_id', null);
            } else {
                $meetingAgendas->where('meeting_id', $meetingId);
            }
        }

        if ($keyword) {
            $meetingAgendas->where(function ($query) use ($keyword) {
                $query->where('subject', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Meeting agendas',
            200,
            [
                'totalCount' => $meetingAgendas->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'meetingAgendas' => $meetingAgendas->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $creatorId
     * @param int|null $meetingId
     * @param string $subject
     *
     * @return ServiceResponse
     */
    public function create(
        int    $creatorId,
        ?int   $meetingId,
        string $subject
    ): ServiceResponse
    {
        $meetingAgenda = new MeetingAgenda;
        $meetingAgenda->creator_id = $creatorId;
        $meetingAgenda->meeting_id = $meetingId;
        $meetingAgenda->subject = $subject;
        $meetingAgenda->save();

        return new ServiceResponse(
            true,
            'Meeting agenda created',
            201,
            $meetingAgenda
        );
    }

    /**
     * @param int $id
     * @param int|null $meetingId
     * @param string $subject
     * @param string|null $discussions
     * @param string|null $result
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        ?int    $meetingId,
        string  $subject,
        ?string $discussions = null,
        ?string $result = null
    ): ServiceResponse
    {
        $meetingAgenda = $this->getById($id);
        if ($meetingAgenda->isSuccess()) {
            $meetingAgenda->getData()->meeting_id = $meetingId;
            $meetingAgenda->getData()->subject = $subject;
            $meetingAgenda->getData()->discussions = $discussions;
            $meetingAgenda->getData()->result = $result;
            $meetingAgenda->getData()->save();

            return new ServiceResponse(
                true,
                'Meeting agenda updated',
                200,
                $meetingAgenda->getData()
            );
        } else {
            return $meetingAgenda;
        }
    }
}
