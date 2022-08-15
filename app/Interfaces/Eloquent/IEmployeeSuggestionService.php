<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IEmployeeSuggestionService extends IEloquentService
{
    /**
     * @param int $employeeId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int     $employeeId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
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
        ?string $keyword = null
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string $subject
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function create(
        int    $employeeId,
        string $subject,
        string $description
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $subject
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $subject,
        string $description
    ): ServiceResponse;
}
