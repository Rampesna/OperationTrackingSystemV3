<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ILeavingReasonService;
use App\Models\Eloquent\LeavingReason;
use App\Services\ServiceResponse;

class LeavingReasonService implements ILeavingReasonService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All leaving reasons',
            200,
            LeavingReason::all()
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
        $leavingReason = LeavingReason::find($id);
        if ($leavingReason) {
            return new ServiceResponse(
                true,
                'Leaving reason',
                200,
                $leavingReason
            );
        } else {
            return new ServiceResponse(
                false,
                'Leaving reason not found',
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
        $leavingReason = $this->getById($id);
        if ($leavingReason->isSuccess()) {
            return new ServiceResponse(
                true,
                'Leaving reason deleted',
                200,
                $leavingReason->getData()->delete()
            );
        } else {
            return $leavingReason;
        }
    }
}
