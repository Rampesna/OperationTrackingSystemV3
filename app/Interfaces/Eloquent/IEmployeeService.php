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
    );

    /**
     * @param int $employeeId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $employeeId,
        int $theme
    );

    /**
     * @param array $ids
     *
     * @return ServiceResponse
     */
    public function getByIds(
        array $ids
    );

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
    public function getByCompanies(
        int         $pageIndex = 0,
        int         $pageSize = 10,
        array       $companyIds = [],
        int         $leave = 0,
        string|null $keyword = null,
        array|null  $jobDepartmentIds = []
    );

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getEmployeeQueues(
        int $employeeId
    );

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getEmployeeShiftGroups(
        int $employeeId
    );

    /**
     * @param int $employeeId
     * @param array $shiftGroupIds
     *
     * @return ServiceResponse
     */
    public function setEmployeeShiftGroups(
        int   $employeeId,
        array $shiftGroupIds
    );

    /**
     * @param int $employeeId
     * @param array $queueIds
     *
     * @return ServiceResponse
     */
    public function setEmployeeQueues(
        int   $employeeId,
        array $queueIds
    );

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getEmployeeCompetences(
        int $employeeId
    );

    /**
     * @param int $employeeId
     * @param array $competenceIds
     *
     * @return ServiceResponse
     */
    public function setEmployeeCompetences(
        int   $employeeId,
        array $competenceIds
    );

    /**
     * @param int $employeeId
     * @param int $jobDepartmentId
     *
     * @return ServiceResponse
     */
    public function updateJobDepartment(
        int $employeeId,
        int $jobDepartmentId
    );

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
    );

    public function update();

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getMarketPayments(
        int $employeeId
    );
}
