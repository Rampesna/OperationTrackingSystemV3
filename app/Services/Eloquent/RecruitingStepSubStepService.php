<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IRecruitingStepSubStepService;
use App\Models\Eloquent\RecruitingStepSubStep;
use App\Services\ServiceResponse;

class RecruitingStepSubStepService implements IRecruitingStepSubStepService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All recruiting step sub steps',
            200,
            RecruitingStepSubStep::all()
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
        $recruitingStepSubStep = RecruitingStepSubStep::find($id);
        if ($recruitingStepSubStep) {
            return new ServiceResponse(
                true,
                'Recruiting step sub step',
                200,
                $recruitingStepSubStep
            );
        } else {
            return new ServiceResponse(
                false,
                'Recruiting step sub step not found',
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
        $recruitingStepSubStep = $this->getById($id);
        if ($recruitingStepSubStep->isSuccess()) {
            return new ServiceResponse(
                true,
                'Recruiting step sub step deleted',
                200,
                $recruitingStepSubStep->getData()->delete()
            );
        } else {
            return $recruitingStepSubStep;
        }
    }

    /**
     * @param int $recruitingStepId
     *
     * @return ServiceResponse
     */
    public function getAllByRecruitingStepId(
        int $recruitingStepId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All recruiting step sub steps',
            200,
            RecruitingStepSubStep::where('recruiting_step_id', $recruitingStepId)->get()
        );
    }

    /**
     * @param int $recruitingStepId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $recruitingStepId,
        string $name
    ): ServiceResponse
    {
        $recruitingStepSubStep = new RecruitingStepSubStep;
        $recruitingStepSubStep->recruiting_step_id = $recruitingStepId;
        $recruitingStepSubStep->name = $name;
        $recruitingStepSubStep->save();

        return new ServiceResponse(
            true,
            'Recruiting step sub step created',
            201,
            $recruitingStepSubStep
        );
    }

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse
    {
        $recruitingStepSubStep = $this->getById($id);
        if ($recruitingStepSubStep->isSuccess()) {
            $recruitingStepSubStep->getData()->name = $name;
            $recruitingStepSubStep->getData()->save();
            return new ServiceResponse(
                true,
                'Recruiting step sub step updated',
                200,
                $recruitingStepSubStep->getData()
            );
        } else {
            return $recruitingStepSubStep;
        }
    }
}
