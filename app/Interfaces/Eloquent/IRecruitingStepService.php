<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IRecruitingStepService extends IEloquentService
{
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
    ): ServiceResponse;

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
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $sms
     * @param string|null $message
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $sms,
        ?string $message = null
    ): ServiceResponse;
}
