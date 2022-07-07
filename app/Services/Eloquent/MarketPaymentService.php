<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IMarketPaymentService;
use App\Models\Eloquent\MarketPayment;

class MarketPaymentService implements IMarketPaymentService
{
    public function getAll()
    {
        return MarketPayment::all();
    }

    public function getById(
        int $id
    )
    {
        return MarketPayment::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function create(
        ?int    $creatorId,
        ?int    $marketId,
        ?int    $relationId,
        ?string $relationType,
        float   $amount,
        ?string $code,
        int     $direction,
        ?int    $completed
    )
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

        return $marketPayment;
    }

    public function getByCode(
        string $code
    )
    {
        return MarketPayment::where('code', $code)->orderBy('created_at', 'desc')->first();
    }

    public function setCompleted(
        int $marketId,
        int $marketPaymentId
    )
    {
        $marketPayment = $this->getById($marketPaymentId);
        $marketPayment->market_id = $marketId;
        $marketPayment->completed = 1;
        $marketPayment->save();

        return $marketPayment;
    }
}
