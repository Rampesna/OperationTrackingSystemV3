<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IMarketPaymentService extends IEloquentService
{
    /**
     * @param int $marketId
     * @param int|null $direction
     * @param string $startDate
     * @param string $endDate
     */
    public function index(
        int    $marketId,
        ?int   $direction,
        string $startDate,
        string $endDate
    ): ServiceResponse;

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
    ): ServiceResponse;

    /**
     * @param string $code
     *
     * @return ServiceResponse
     */
    public function getByCode(
        string $code
    ): ServiceResponse;

    /**
     * @param int $marketId
     * @param int $marketPaymentId
     *
     * @return ServiceResponse
     */
    public function setCompleted(
        int $marketId,
        int $marketPaymentId
    ): ServiceResponse;
}
