<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IMeetingTypeService;
use App\Models\Eloquent\MeetingType;
use App\Services\ServiceResponse;

class MeetingTypeService implements IMeetingTypeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All meeting types',
            200,
            MeetingType::all()
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
        $meetingType = MeetingType::find($id);
        if ($meetingType) {
            return new ServiceResponse(
                true,
                'Meeting type',
                200,
                $meetingType
            );
        } else {
            return new ServiceResponse(
                false,
                'Meeting type not found',
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
        $meetingType = $this->getById($id);
        if ($meetingType->isSuccess()) {
            return new ServiceResponse(
                true,
                'Meeting type deleted',
                200,
                $meetingType->getData()->delete()
            );
        } else {
            return $meetingType;
        }
    }
}
