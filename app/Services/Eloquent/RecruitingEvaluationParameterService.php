<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IRecruitingEvaluationParameterService;
use App\Models\Eloquent\RecruitingEvaluationParameter;
use App\Services\ServiceResponse;

class RecruitingEvaluationParameterService implements IRecruitingEvaluationParameterService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All recruiting evaluation parameters',
            200,
            RecruitingEvaluationParameter::all()
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
        $recruitingEvaluationParameter = RecruitingEvaluationParameter::find($id);
        if ($recruitingEvaluationParameter) {
            return new ServiceResponse(
                true,
                'Recruiting evaluation parameter',
                200,
                $recruitingEvaluationParameter
            );
        } else {
            return new ServiceResponse(
                false,
                'Recruiting evaluation parameter not found',
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
        $recruitingEvaluationParameter = $this->getById($id);
        if ($recruitingEvaluationParameter->isSuccess()) {
            return new ServiceResponse(
                true,
                'Recruiting evaluation parameter deleted',
                200,
                $recruitingEvaluationParameter->getData()->delete()
            );
        } else {
            return $recruitingEvaluationParameter;
        }
    }

    /**
     * @param int $recruitingId
     */
    public function getAllByRecruitingId(
        int $recruitingId,
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Recruiting evaluation parameters',
            200,
            RecruitingEvaluationParameter::where('recruiting_id', $recruitingId)->get()
        );
    }

    /**
     * @param int $recruitingId
     * @param string $parameter
     */
    public function create(
        int    $recruitingId,
        string $parameter
    ): ServiceResponse
    {
        $recruitingEvaluationParameter = new RecruitingEvaluationParameter();
        $recruitingEvaluationParameter->recruiting_id = $recruitingId;
        $recruitingEvaluationParameter->parameter = $parameter;
        $recruitingEvaluationParameter->save();
        return new ServiceResponse(
            true,
            'Recruiting evaluation parameter created',
            200,
            $recruitingEvaluationParameter
        );
    }

    /**
     * @param int $id
     */
    public function check(
        int $id,
    ): ServiceResponse
    {
        $recruitingEvaluationParameter = $this->getById($id);
        if ($recruitingEvaluationParameter->isSuccess()) {
            $recruitingEvaluationParameter->getData()->check = $recruitingEvaluationParameter->getData()->check == 1 ? 0 : 1;
            $recruitingEvaluationParameter->getData()->save();
            return new ServiceResponse(
                true,
                'Recruiting evaluation parameter updated',
                200,
                $recruitingEvaluationParameter->getData()
            );
        } else {
            return $recruitingEvaluationParameter;
        }
    }
}
