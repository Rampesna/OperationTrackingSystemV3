<?php

namespace App\Interfaces\Eloquent;

interface IMarketPaymentService extends IEloquentService
{
    /**
     * @param int|null $creatorId
     * @param int|null $marketId
     * @param int|null $relationId
     * @param string|null $relationType
     * @param float $amount
     * @param string|null $code
     * @param int $direction
     * @param int|null $completed
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
    );
}
