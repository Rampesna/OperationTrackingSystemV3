<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IEmployeeService extends IEloquentService
{
    /**
     * @param string $email
     *
     * @return ServiceResponse
     */
    public function getByEmail(
        string $email
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $employeeId,
        int $theme
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string $deviceToken
     *
     * @return ServiceResponse
     */
    public function setDeviceToken(
        int    $employeeId,
        string $deviceToken
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
     * @param int $pageIndex
     * @param int $pageSize
     * @param array $companyIds
     * @param int $leave
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        int         $pageIndex = 0,
        int         $pageSize = 10,
        array       $companyIds = [],
        int         $leave = 0,
        string|null $keyword = null,
        array|null  $jobDepartmentIds = []
    ): ServiceResponse;

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getEmployeeQueues(
        int $employeeId
    ): ServiceResponse;

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getEmployeeShiftGroups(
        int $employeeId
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param array $shiftGroupIds
     *
     * @return ServiceResponse
     */
    public function setEmployeeShiftGroups(
        int   $employeeId,
        array $shiftGroupIds
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param array $queueIds
     *
     * @return ServiceResponse
     */
    public function setEmployeeQueues(
        int   $employeeId,
        array $queueIds
    ): ServiceResponse;

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getEmployeeCompetences(
        int $employeeId
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param array $competenceIds
     *
     * @return ServiceResponse
     */
    public function setEmployeeCompetences(
        int   $employeeId,
        array $competenceIds
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param int $jobDepartmentId
     *
     * @return ServiceResponse
     */
    public function updateJobDepartment(
        int $employeeId,
        int $jobDepartmentId
    ): ServiceResponse;

    /**
     * @param int|null $guid
     * @param int $companyId
     * @param int $roleId
     * @param int $jobDepartmentId
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     * @param string|null $santralCode
     * @param string|null $password
     *
     * @return ServiceResponse
     */
    public function create(
        ?int    $guid,
        int     $companyId,
        int     $roleId,
        int     $jobDepartmentId,
        string  $name,
        string  $email,
        ?string $phone,
        ?string $identity,
        ?string $santralCode,
        ?string $password
    ): ServiceResponse;

    public function update(): ServiceResponse;

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getMarketPayments(
        int $employeeId
    ): ServiceResponse;
}
