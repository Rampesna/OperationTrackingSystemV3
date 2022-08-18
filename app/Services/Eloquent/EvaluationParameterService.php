<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEvaluationParameterService;
use App\Models\Eloquent\EvaluationParameter;
use App\Services\ServiceResponse;

class EvaluationParameterService implements IEvaluationParameterService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All evaluation parameters',
            200,
            EvaluationParameter::all()
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
        $evaluationParameter = EvaluationParameter::find($id);
        if ($evaluationParameter) {
            return new ServiceResponse(
                true,
                'Evaluation parameter',
                200,
                $evaluationParameter
            );
        } else {
            return new ServiceResponse(
                false,
                'Evaluation parameter not found',
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
        $evaluationParameter = $this->getById($id);
        if ($evaluationParameter->isSuccess()) {
            return new ServiceResponse(
                true,
                'Evaluation parameter deleted',
                200,
                $evaluationParameter->getData()->delete()
            );
        } else {
            return $evaluationParameter;
        }
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
    ): ServiceResponse
    {
        $evaluationParameters = EvaluationParameter::with([]);

        if ($keyword) {
            $evaluationParameters = $evaluationParameters->where(function ($evaluationParameters) use ($keyword) {
                $evaluationParameters->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Evaluation parameters',
            200,
            [
                'totalCount' => $evaluationParameters->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'evaluationParameters' => $evaluationParameters->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        string $name
    ): ServiceResponse
    {
        $evaluationParameter = new EvaluationParameter();
        $evaluationParameter->name = $name;
        $evaluationParameter->save();
        return new ServiceResponse(
            true,
            'Evaluation parameter created',
            201,
            $evaluationParameter
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
        $evaluationParameter = $this->getById($id);
        if ($evaluationParameter->isSuccess()) {
            $evaluationParameter->getData()->name = $name;
            $evaluationParameter->getData()->save();
            return new ServiceResponse(
                true,
                'Evaluation parameter updated',
                200,
                $evaluationParameter->getData()
            );
        } else {
            return $evaluationParameter;
        }
    }
}
