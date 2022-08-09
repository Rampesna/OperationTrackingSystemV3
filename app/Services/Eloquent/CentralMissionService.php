<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICentralMissionService;
use App\Models\Eloquent\CentralMission;
use App\Services\ServiceResponse;

class CentralMissionService implements ICentralMissionService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All central missions',
            200,
            CentralMission::all()
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
        $centralMission = CentralMission::find($id);
        if ($centralMission) {
            return new ServiceResponse(
                true,
                'Central mission',
                200,
                $centralMission
            );
        } else {
            return new ServiceResponse(
                false,
                'Central mission not found',
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
        $centralMission = $this->getById($id);
        if ($centralMission->isSuccess()) {
            return new ServiceResponse(
                true,
                'Central mission deleted',
                200,
                $centralMission->getData()->delete()
            );
        } else {
            return $centralMission;
        }
    }

    /**
     * @param string $relationType
     * @param int $relationId
     * @param int $pageIndex
     * @param int $pageSize
     * @param array|null $typeIds
     * @param array|null $statusIds
     *
     * @return ServiceResponse
     */
    public function getByRelation(
        string $relationType,
        int    $relationId,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        ?array $typeIds = [],
        ?array $statusIds = []
    ): ServiceResponse
    {
        $centralMissions = CentralMission::with([
            'relation',
            'type',
            'status'
        ])->where('relation_type', $relationType)->where('relation_id', $relationId);

        if ($typeIds && count($typeIds) > 0) {
            $centralMissions->whereIn('type_id', $typeIds);
        }

        if ($statusIds && count($statusIds) > 0) {
            $centralMissions->whereIn('status_id', $statusIds);
        }

        return new ServiceResponse(
            true,
            'Central missions',
            200,
            [
                'totalCount' => $centralMissions->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'centralMissions' => $centralMissions->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $typeId
     * @param int $statusId
     * @param int $relationId
     * @param string $relationType
     * @param string $title
     * @param string|null $description
     * @param string|null $startDate
     * @param string|null $endDate
     *
     * @return ServiceResponse
     */
    public function create(
        int     $typeId,
        int     $statusId,
        int     $relationId,
        string  $relationType,
        string  $title,
        ?string $description,
        ?string $startDate,
        ?string $endDate,
    ): ServiceResponse
    {
        $centralMission = new CentralMission();
        $centralMission->type_id = $typeId;
        $centralMission->status_id = $statusId;
        $centralMission->relation_id = $relationId;
        $centralMission->relation_type = $relationType;
        $centralMission->title = $title;
        $centralMission->description = $description;
        $centralMission->start_date = $startDate;
        $centralMission->end_date = $endDate;
        $centralMission->save();

        return new ServiceResponse(
            true,
            'Central mission created',
            201,
            $centralMission
        );
    }

    /**
     * @param int $id
     * @param int $typeId
     * @param int $statusId
     * @param int $relationId
     * @param string $relationType
     * @param string $title
     * @param string|null $description
     * @param string|null $startDate
     * @param string|null $endDate
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $typeId,
        int     $statusId,
        int     $relationId,
        string  $relationType,
        string  $title,
        ?string $description,
        ?string $startDate,
        ?string $endDate,
    ): ServiceResponse
    {
        $centralMission = $this->getById($id);
        if ($centralMission->isSuccess()) {
            $centralMission->getData()->type_id = $typeId;
            $centralMission->getData()->status_id = $statusId;
            $centralMission->getData()->relation_id = $relationId;
            $centralMission->getData()->relation_type = $relationType;
            $centralMission->getData()->title = $title;
            $centralMission->getData()->description = $description;
            $centralMission->getData()->start_date = $startDate;
            $centralMission->getData()->end_date = $endDate;
            $centralMission->getData()->save();

            return new ServiceResponse(
                true,
                'Central mission updated',
                200,
                $centralMission->getData()
            );
        } else {
            return $centralMission;
        }
    }

    /**
     * @param int $id
     * @param string $diagram
     *
     * @return ServiceResponse
     */
    public function updateDiagram(
        int    $id,
        string $diagram,
    ): ServiceResponse
    {
        $centralMission = $this->getById($id);
        if ($centralMission->isSuccess()) {
            $centralMission->getData()->diagram = $diagram;
            $centralMission->getData()->save();

            return new ServiceResponse(
                true,
                'Central mission diagram updated',
                200,
                $centralMission->getData()
            );
        } else {
            return $centralMission;
        }
    }
}
