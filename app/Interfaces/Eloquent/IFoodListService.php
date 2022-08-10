<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IFoodListService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        array  $companyIds,
        string $startDate,
        string $endDate
    ): ServiceResponse;

    /**
     * @param int $companyId
     * @param string $date
     *
     * @return ServiceResponse
     */
    public function getByCompanyIdAndDate(
        int    $companyId,
        string $date
    ): ServiceResponse;

    /**
     * @param int $companyId
     * @param string $name
     * @param string|null $description
     * @param string $date
     * @param int|null $count
     */
    public function create(
        int     $companyId,
        string  $name,
        ?string $description,
        string  $date,
        ?int    $count
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $name
     * @param string|null $description
     */
    public function update(
        int     $id,
        string  $name,
        ?string $description,
    ): ServiceResponse;

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function report(
        array  $companyIds,
        string $startDate,
        string $endDate
    ): ServiceResponse;
}
