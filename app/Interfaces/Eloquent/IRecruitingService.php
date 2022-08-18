<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IRecruitingService extends IEloquentService
{
    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param array|null $departmentIds
     * @param array|null $stepIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array   $companyIds,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null,
        ?array  $departmentIds = [],
        ?array  $stepIds = []
    ): ServiceResponse;

    /**
     * @param int $companyId
     * @param int $departmentId
     * @param string $name
     * @param string $email
     * @param string $phoneNumber
     * @param string $identity
     * @param string $birthDate
     * @param int $obstacle
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        int    $departmentId,
        string $name,
        string $email,
        string $phoneNumber,
        string $identity,
        string $birthDate,
        int    $obstacle
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $companyId
     * @param int $departmentId
     * @param string $name
     * @param string $email
     * @param string $phoneNumber
     * @param string $identity
     * @param string $birthDate
     * @param int $obstacle
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        int    $departmentId,
        string $name,
        string $email,
        string $phoneNumber,
        string $identity,
        string $birthDate,
        int    $obstacle
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int|string $cv
     */
    public function updateCv(
        int        $id,
        int|string $cv
    ): ServiceResponse;

    /**
     * @param int $id
     */
    public function cancel(
        int $id,
    ): ServiceResponse;

    /**
     * @param int $id
     */
    public function reactivate(
        int $id,
    ): ServiceResponse;

    /**
     * @param int $id
     */
    public function wizard(
        int $id,
    ): ServiceResponse;
}
