<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICentralMissionTypeService;
use App\Models\Eloquent\CentralMissionType;
use App\Services\ServiceResponse;

class CentralMissionTypeService implements ICentralMissionTypeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All central mission types',
            200,
            CentralMissionType::all()
        );
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
    ): ServiceResponse
    {
        $centralMissionTypes = CentralMissionType::with([]);

        if ($keyword) {
            $centralMissionTypes->where('name', 'like', '%' . $keyword . '%');
        }

        return new ServiceResponse(
            true,
            'Central mission types',
            200,
            [
                'totalCount' => $centralMissionTypes->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'centralMissionTypes' => $centralMissionTypes->skip($pageSize * $pageIndex)
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
        $centralMissionType = CentralMissionType::find($id);
        if ($centralMissionType) {
            return new ServiceResponse(
                true,
                'Central mission type',
                200,
                $centralMissionType
            );
        } else {
            return new ServiceResponse(
                false,
                'Central mission type not found',
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
        $centralMissionType = $this->getById($id);
        if ($centralMissionType->isSuccess()) {
            return new ServiceResponse(
                true,
                'Central mission type deleted',
                200,
                $centralMissionType->getData()->delete()
            );
        } else {
            return $centralMissionType;
        }
    }

    /**
     * @param string $name
     */
    public function create(
        string $name
    ): ServiceResponse
    {
        $centralMissionType = new CentralMissionType;
        $centralMissionType->name = $name;
        $centralMissionType->save();

        return new ServiceResponse(
            true,
            'Central mission type created',
            201,
            $centralMissionType
        );
    }

    /**
     * @param int $id
     * @param string $name
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse
    {
        $centralMissionType = $this->getById($id);
        if ($centralMissionType->isSuccess()) {
            $centralMissionType->getData()->name = $name;
            $centralMissionType->getData()->save();

            return new ServiceResponse(
                true,
                'Central mission type updated',
                200,
                $centralMissionType
            );
        } else {
            return $centralMissionType;
        }
    }
}
