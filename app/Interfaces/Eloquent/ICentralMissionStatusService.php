<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ICentralMissionStatusService extends IEloquentService
{
    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
    ): ServiceResponse;

    /**
     * @param string $name
     */
    public function create(
        string $name
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $name
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse;
}
