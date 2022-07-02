<?php

namespace App\Interfaces\Eloquent;

interface IEmployeeService extends IEloquentService
{
    /**
     * @param string $email
     */
    public function getByEmail(
        string $email
    );

    /**
     * @param int $employeeId
     * @param int $theme
     */
    public function swapTheme(
        int $employeeId,
        int $theme
    );

    /**
     * @param array $ids
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
     */
    public function getEmployeeQueues(
        int $employeeId
    );

    /**
     * @param int $employeeId
     */
    public function getEmployeeShiftGroups(
        int $employeeId
    );

    /**
     * @param int $employeeId
     * @param array $shiftGroupIds
     */
    public function setEmployeeShiftGroups(
        int   $employeeId,
        array $shiftGroupIds
    );

    /**
     * @param int $employeeId
     * @param array $queueIds
     */
    public function setEmployeeQueues(
        int   $employeeId,
        array $queueIds
    );

    /**
     * @param int $employeeId
     */
    public function getEmployeeCompetences(
        int $employeeId
    );

    /**
     * @param int $employeeId
     * @param array $competenceIds
     */
    public function setEmployeeCompetences(
        int   $employeeId,
        array $competenceIds
    );

    /**
     * @param int $employeeId
     * @param int $jobDepartmentId
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
}
