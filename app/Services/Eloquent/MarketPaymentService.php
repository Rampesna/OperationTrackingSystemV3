<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IMarketPaymentService;
use App\Models\Eloquent\MarketPayment;
use App\Services\ServiceResponse;

class MarketPaymentService implements IMarketPaymentService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All market payments',
            200,
            MarketPayment::all()
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
        $marketPayment = MarketPayment::find($id);
        if ($marketPayment) {
            return new ServiceResponse(
                true,
                'Market payment',
                200,
                $marketPayment
            );
        } else {
            return new ServiceResponse(
                false,
                'Market payment not found',
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
        $marketPayment = $this->getById($id);
        if ($marketPayment->isSuccess()) {
            return new ServiceResponse(
                true,
                'Market payment deleted',
                200,
                $marketPayment->getData()->delete()
            );
        } else {
            return $marketPayment;
        }
    }

    /**
     * @param int|null $creatorId
     * @param int|null $marketId
     * @param int|null $relationId
     * @param string|null $relationType
     * @param float $amount
     * @param string|null $code
     * @param int $direction
     * @param int|null $completed
     *
     * @return ServiceResponse
     */
    public function create(
        ?int    $creatorId,
        ?int    $marketId,
        ?int    $relationId,
        ?string $relationType,
        float   $amount,
        ?string $code,
        int     $direction,
        ?int    $completed
    ): ServiceResponse
    {
        $marketPayment = new MarketPayment;
        $marketPayment->creator_id = $creatorId;
        $marketPayment->market_id = $marketId;
        $marketPayment->relation_id = $relationId;
        $marketPayment->relation_type = $relationType;
        $marketPayment->amount = $amount;
        $marketPayment->code = $code;
        $marketPayment->direction = $direction;
        $marketPayment->completed = $completed;
        $marketPayment->save();

        return new ServiceResponse(
            true,
            'Market payment created',
            201,
            $marketPayment
        );
    }

    /**
     * @param string $code
     *
     * @return ServiceResponse
     */
    public function getByCode(
        string $code
    ): ServiceResponse
    {
        $marketPayment = MarketPayment::where('code', $code)->orderBy('created_at', 'desc')->first();
        if ($marketPayment) {
            return new ServiceResponse(
                true,
                'Market payment',
                200,
                $marketPayment
            );
        } else {
            return new ServiceResponse(
                false,
                'Market payment not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $marketId
     * @param int $marketPaymentId
     *
     * @return ServiceResponse
     */
    public function setCompleted(
        int $marketId,
        int $marketPaymentId
    ): ServiceResponse
    {
        $marketPayment = $this->getById($marketPaymentId);
        if ($marketPayment->isSuccess()) {
            $marketPayment->getData()->market_id = $marketId;
            $marketPayment->getData()->completed = 1;
            $marketPayment->getData()->save();

            return new ServiceResponse(
                true,
                'Market payment completed',
                200,
                $marketPayment->getData()
            );
        } else {
            return $marketPayment;
        }
    }
}
