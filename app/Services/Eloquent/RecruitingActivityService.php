<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IRecruitingActivityService;
use App\Models\Eloquent\RecruitingActivity;
use App\Services\ServiceResponse;

class RecruitingActivityService implements IRecruitingActivityService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All recruiting activities',
            200,
            RecruitingActivity::all()
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
        $recruitingActivity = RecruitingActivity::find($id);
        if ($recruitingActivity) {
            return new ServiceResponse(
                true,
                'Recruiting activity',
                200,
                $recruitingActivity
            );
        } else {
            return new ServiceResponse(
                false,
                'Recruiting activity not found',
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
        $recruitingActivity = $this->getById($id);
        if ($recruitingActivity->isSuccess()) {
            return new ServiceResponse(
                true,
                'Recruiting activity deleted',
                200,
                $recruitingActivity->getData()->delete()
            );
        } else {
            return $recruitingActivity;
        }
    }

    /**
     * @param int $recruitingId
     *
     * @return ServiceResponse
     */
    public function getByRecruitingId(
        int $recruitingId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Recruiting activities',
            200,
            RecruitingActivity::with([
                'user',
            ])->where('recruiting_id', $recruitingId)->get()
        );
    }

    /**
     * @param int $recruitingId
     * @param string $transaction
     * @param int $userId
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function create(
        int    $recruitingId,
        string $transaction,
        int    $userId,
        string $description = null
    ): ServiceResponse
    {
        $recruitingActivity = new RecruitingActivity();
        $recruitingActivity->recruiting_id = $recruitingId;
        $recruitingActivity->transaction = $transaction;
        $recruitingActivity->user_id = $userId;
        $recruitingActivity->description = $description;
        $recruitingActivity->save();

        return new ServiceResponse(
            true,
            'Recruiting activity created',
            200,
            $recruitingActivity
        );
    }
}
