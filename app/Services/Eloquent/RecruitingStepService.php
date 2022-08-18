<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IRecruitingStepService;
use App\Models\Eloquent\RecruitingStep;
use App\Services\ServiceResponse;

class RecruitingStepService implements IRecruitingStepService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All recruitment steps',
            200,
            RecruitingStep::all()
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
        $recruitingStep = RecruitingStep::find($id);
        if ($recruitingStep) {
            return new ServiceResponse(
                true,
                'Recruiting step',
                200,
                $recruitingStep
            );
        } else {
            return new ServiceResponse(
                false,
                'Recruiting step not found',
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
        $recruitingStep = $this->getById($id);
        if ($recruitingStep->isSuccess()) {
            return new ServiceResponse(
                true,
                'Recruiting step deleted',
                200,
                $recruitingStep->getData()->delete()
            );
        } else {
            return $recruitingStep;
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
        $recruitingSteps = RecruitingStep::with([]);

        if ($keyword) {
            $recruitingSteps->where(function ($recruitingSteps) use ($keyword) {
                $recruitingSteps->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Recruiting steps',
            200,
            [
                'totalCount' => $recruitingSteps->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'recruitingSteps' => $recruitingSteps->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param string $name
     * @param string $color
     * @param int $sms
     * @param string|null $message
     *
     * @return ServiceResponse
     */
    public function create(
        string  $name,
        string  $color,
        int     $sms,
        ?string $message = null
    ): ServiceResponse
    {
        $recruitingStep = new RecruitingStep();
        $recruitingStep->name = $name;
        $recruitingStep->color = $color;
        $recruitingStep->sms = $sms;
        $recruitingStep->message = $message;
        $recruitingStep->save();
        return new ServiceResponse(
            true,
            'Recruiting step created',
            201,
            $recruitingStep
        );
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $color
     * @param int $sms
     * @param string|null $message
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        string  $name,
        string  $color,
        int     $sms,
        ?string $message = null
    ): ServiceResponse
    {
        $recruitingStep = $this->getById($id);
        if ($recruitingStep->isSuccess()) {
            $recruitingStep->getData()->name = $name;
            $recruitingStep->getData()->color = $color;
            $recruitingStep->getData()->sms = $sms;
            $recruitingStep->getData()->message = $message;
            $recruitingStep->getData()->save();
            return new ServiceResponse(
                true,
                'Recruiting step updated',
                200,
                $recruitingStep->getData()
            );
        } else {
            return $recruitingStep;
        }
    }
}
