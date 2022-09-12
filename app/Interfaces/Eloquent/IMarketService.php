<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IMarketService extends IEloquentService
{
    /**
     * @param string $code
     *
     * @return ServiceResponse
     */
    public function getByCode(
        string $code
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getProfile(
        int $id
    ): ServiceResponse;

    /**
     * @param string $name
     * @param string $code
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function register(
        string $name,
        string $code,
        string $password
    ): ServiceResponse;

    /**
     * @param int $marketId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $marketId,
        int $theme
    ): ServiceResponse;

    /**
     * @param array $ids
     *
     * @return ServiceResponse
     */
    public function getByIds(
        array $ids
    ): ServiceResponse;

    /**
     * @param int $marketId
     *
     * @return ServiceResponse
     */
    public function getMarketPayments(
        int $marketId
    ): ServiceResponse;

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
        ?string $keyword
    ): ServiceResponse;

    /**
     * @param string $code
     * @param string $name
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function create(
        string $code,
        string $name,
        string $password
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $code
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $code,
        string $name
    ): ServiceResponse;
}
