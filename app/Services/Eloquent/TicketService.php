<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITicketService;
use App\Models\Eloquent\Ticket;
use App\Services\ServiceResponse;

class TicketService implements ITicketService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All tickets',
            200,
            Ticket::all()
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
        $ticket = Ticket::find($id);
        if ($ticket) {
            return new ServiceResponse(
                true,
                'Ticket',
                200,
                $ticket
            );
        } else {
            return new ServiceResponse(
                false,
                'Ticket not found',
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
        $ticket = $this->getById($id);
        if ($ticket->isSuccess()) {
            return new ServiceResponse(
                true,
                'Ticket deleted',
                200,
                $ticket->getData()->delete()
            );
        } else {
            return $ticket;
        }
    }

    /**
     * @param string $relationType
     * @param int $relationId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param array|null $priorityIds
     * @param array|null $statusIds
     *
     * @return ServiceResponse
     */
    public function getByRelation(
        string  $relationType,
        int     $relationId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword,
        ?array  $priorityIds,
        ?array  $statusIds
    ): ServiceResponse
    {
        $tickets = Ticket::with([
            'relation',
            'creator',
            'priority',
            'status',
        ])->orderBy('id', 'desc')->where('relation_type', $relationType)->where('relation_id', $relationId);

        if ($keyword) {
            $tickets->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
            });
        }

        if ($priorityIds && count($priorityIds) > 0) {
            $tickets->whereIn('priority_id', $priorityIds);
        }

        if ($statusIds && count($statusIds) > 0) {
            $tickets->whereIn('status_id', $statusIds);
        }

        return new ServiceResponse(
            true,
            'Tickets',
            200,
            [
                'totalCount' => $tickets->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'tickets' => $tickets->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param string $creatorType
     * @param int $creatorId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param array|null $priorityIds
     * @param array|null $statusIds
     *
     * @return ServiceResponse
     */
    public function getByCreator(
        string  $creatorType,
        int     $creatorId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword,
        ?array  $priorityIds,
        ?array  $statusIds
    ): ServiceResponse
    {
        $tickets = Ticket::with([
            'relation',
            'creator',
            'priority',
            'status',
        ])->orderBy('id', 'desc')->where('creator_type', $creatorType)->where('creator_id', $creatorId);

        if ($keyword) {
            $tickets->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
            });
        }

        if ($priorityIds && count($priorityIds) > 0) {
            $tickets->whereIn('priority_id', $priorityIds);
        }

        if ($statusIds && count($statusIds) > 0) {
            $tickets->whereIn('status_id', $statusIds);
        }

        return new ServiceResponse(
            true,
            'Tickets',
            200,
            [
                'totalCount' => $tickets->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'tickets' => $tickets->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $creatorType
     * @param int $creatorId
     * @param int $priorityId
     * @param int|null $subjectId
     * @param int $statusId
     * @param string $title
     * @param string|null $source
     * @param string|null $description
     * @param string|null $notes
     * @param string|null $requestedEndDate
     * @param string|null $todoEndDate
     *
     * @return ServiceResponse
     */
    public function create(
        string  $relationType,
        int     $relationId,
        string  $creatorType,
        int     $creatorId,
        int     $priorityId,
        ?int    $subjectId,
        int     $statusId,
        string  $title,
        ?string $source,
        ?string $description,
        ?string $notes,
        ?string $requestedEndDate,
        ?string $todoEndDate
    ): ServiceResponse
    {
        $ticket = new Ticket;
        $ticket->relation_type = $relationType;
        $ticket->relation_id = $relationId;
        $ticket->creator_type = $creatorType;
        $ticket->creator_id = $creatorId;
        $ticket->priority_id = $priorityId;
        $ticket->subject_id = $subjectId;
        $ticket->status_id = $statusId;
        $ticket->title = $title;
        $ticket->source = $source;
        $ticket->description = $description;
        $ticket->notes = $notes;
        $ticket->requested_end_date = $requestedEndDate;
        $ticket->todo_end_date = $todoEndDate;
        $ticket->save();
        return new ServiceResponse(
            true,
            'Ticket created',
            201,
            $ticket
        );
    }

    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $creatorType
     * @param int $creatorId
     * @param int $priorityId
     * @param int|null $subjectId
     * @param int $statusId
     * @param string $title
     * @param string|null $source
     * @param string|null $description
     * @param string|null $notes
     * @param string|null $requestedEndDate
     * @param string|null $todoEndDate
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        string  $relationType,
        int     $relationId,
        string  $creatorType,
        int     $creatorId,
        int     $priorityId,
        ?int    $subjectId,
        int     $statusId,
        string  $title,
        ?string $source,
        ?string $description,
        ?string $notes,
        ?string $requestedEndDate,
        ?string $todoEndDate
    ): ServiceResponse
    {
        $ticket = $this->getById($id);
        if ($ticket->isSuccess()) {
            $ticket->getData()->relation_type = $relationType;
            $ticket->getData()->relation_id = $relationId;
            $ticket->getData()->creator_type = $creatorType;
            $ticket->getData()->creator_id = $creatorId;
            $ticket->getData()->priority_id = $priorityId;
            $ticket->getData()->subject_id = $subjectId;
            $ticket->getData()->status_id = $statusId;
            $ticket->getData()->title = $title;
            $ticket->getData()->source = $source;
            $ticket->getData()->description = $description;
            $ticket->getData()->notes = $notes;
            $ticket->getData()->requested_end_date = $requestedEndDate;
            $ticket->getData()->todo_end_date = $todoEndDate;
            $ticket->getData()->save();
            return new ServiceResponse(
                true,
                'Ticket updated',
                200,
                $ticket->getData()
            );
        } else {
            return $ticket;
        }
    }
}
