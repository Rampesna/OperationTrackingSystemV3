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
     * @param int $pageIndex
     * @param int $pageSize
     * @param array $companyIds
     * @param int $leave
     */
    public function getByCompanies(
        int   $pageIndex = 0,
        int   $pageSize = 10,
        array $companyIds = [],
        int   $leave = 0
    );

    /**
     * @param int $employeeId
     */
    public function getEmployeeQueues(
        int $employeeId
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
     */
    public function getEmployeePriorities(
        int $employeeId
    );

    /**
     * @param int $employeeId
     * @param array $priorityIds
     */
    public function setEmployeePriorities(
        int   $employeeId,
        array $priorityIds
    );

    public function create(
        int    $roleId,
        string $name,
        string $email,
        string $phoneNumber = null,
        string $identificationNumber = null,
        int    $defaultCompanyId = null,
        string $password
    );

    public function update();
}
