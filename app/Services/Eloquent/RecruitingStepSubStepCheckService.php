<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IRecruitingStepSubStepCheckService;
use App\Models\Eloquent\RecruitingStepSubStepCheck;
use App\Services\ServiceResponse;

class RecruitingStepSubStepCheckService implements IRecruitingStepSubStepCheckService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All recruiting step sub step checks',
            200,
            RecruitingStepSubStepCheck::all()
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
        $recruitingStepSubStepCheck = RecruitingStepSubStepCheck::find($id);
        if ($recruitingStepSubStepCheck) {
            return new ServiceResponse(
                true,
                'Recruiting step sub step check',
                200,
                $recruitingStepSubStepCheck
            );
        } else {
            return new ServiceResponse(
                false,
                'Recruiting step sub step check not found',
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
        $recruitingStepSubStepCheck = $this->getById($id);
        if ($recruitingStepSubStepCheck->isSuccess()) {
            return new ServiceResponse(
                true,
                'Recruiting step sub step check deleted',
                200,
                $recruitingStepSubStepCheck->getData()->delete()
            );
        } else {
            return $recruitingStepSubStepCheck;
        }
    }

    /**
     * @param int $recruitingId
     * @param int $recruitingStepId
     * @param int $recruitingStepSubStepId
     * @param int $userId
     */
    public function create(
        int $recruitingId,
        int $recruitingStepId,
        int $recruitingStepSubStepId,
        int $userId
    ): ServiceResponse
    {
        $recruitingStepSubStepCheck = new RecruitingStepSubStepCheck();
        $recruitingStepSubStepCheck->recruiting_id = $recruitingId;
        $recruitingStepSubStepCheck->recruiting_step_id = $recruitingStepId;
        $recruitingStepSubStepCheck->recruiting_step_sub_step_id = $recruitingStepSubStepId;
        $recruitingStepSubStepCheck->user_id = $userId;
        $recruitingStepSubStepCheck->save();
        return new ServiceResponse(
            true,
            'Recruiting step sub step check created',
            200,
            $recruitingStepSubStepCheck
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function updateCheck(
        int $id
    ): ServiceResponse
    {
        $recruitingStepSubStepCheck = $this->getById($id);
        if ($recruitingStepSubStepCheck->isSuccess()) {
            $recruitingStepSubStepCheck->getData()->check = $recruitingStepSubStepCheck->getData()->check == 1 ? 0 : 1;
            $recruitingStepSubStepCheck->getData()->save();

            return new ServiceResponse(
                true,
                'Recruiting step sub step check updated',
                200,
                $recruitingStepSubStepCheck->getData()
            );
        } else {
            return $recruitingStepSubStepCheck;
        }
    }
}
